<?php

namespace App\Repositories;

use App\Http\Requests\DepartementRequest;
use App\Interfaces\DepartementInterface;
use App\Traits\ResponseAPI;
use App\Models\Departement;
use Carbon\Carbon;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DepartementRepository implements DepartementInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllDepartements($nested = false)
    {
        try {
            if ($nested) {
                $departements = Departement::where('parent_id', 0)->with(str_repeat('children.', 99))->get();
            } else {
                $departements = Departement::orderBy('id', 'asc')->with('parent')->get();

                $departements->transform(function ($departement) {
                    return [
                        'id' => $departement->id,
                        'kode' => $departement->kode,
                        'name' => $departement->name,
                        'parent' => ($departement->parent_id > 0) ? $departement->parent->name : ''
                    ];
                });
            }

            if ($departements == null) return $this->error('Data Departement Kosong', 404);
            //    return new DepartementCollection($departements);
            return $this->success("All Departements", $departements);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function getOptionDepartement()
    {
        $departements = Departement::where('parent_id', 0)->orderBy('id')->get();
        if (!empty($departements)) {

            $html = $this->toOption($departements, 0);
            return  $html;
        } else {
            return '';
        }
    }

    public function getOptionDepartement2()
    {
        if (request()->q) {
            $departements = Departement::where(DB::raw('lower(name)'), 'LIKE', '%' . request()->q . '%')->orderBy('id')->get();
        } else {
            $departements = Departement::where('parent_id', 0)->orderBy('id')->get();
        }

        if (!empty($departements)) {
            $html = $this->toOption2($departements, 0);
            return  json_encode($html);
        } else {
            return '';
        }
    }

    public function toUL(array $array, $level = 1)
    {
        $html = '';
        if (count($array)) {
            foreach ($array as $value) {
                $html .= sprintf('<a  class="dropdown-item" data-value="%s" data-level="%s" href="#">%s </a>', $value->id, $level, $value->name);
                if (!empty($value->children)) {
                    $html .= $this->toUL($value->children->sortBy('id')->values()->all(), $level + 1);
                }
            }
        }
        return $html;
    }

    public function toOption($array, $level = 0)
    {
        $html = '';
        if (count($array)) {
            foreach ($array as $value) {
                $html .= sprintf('<option value="%s" >%s</option>', $value->id, ($level > 0) ? str_repeat('&#160;&#160;&#160;', $level) . $value->name : $value->name);
                if (!empty($value->children)) {
                    $html .= $this->toOption($value->children->sortBy('id')->values()->all(), $level + 1);
                }
            }
        }
        return $html;
    }

    public function toOption2($array, $level = 0)
    {
        $response = array();
        if (count($array)) {
            foreach ($array as $value) {
                $response[] = [
                    "id" =>  $value->id,
                    "text" => ($level > 0) ? str_repeat('--', $level) . $value->name : $value->name
                ];

                if (!empty($value->children)) {
                    $response2 = $this->toOption2($value->children->sortBy('id')->values()->all(), $level + 1);
                    $response = array_merge($response, $response2);
                }
            }
        }
        return $response;
    }

    public function departementJson()
    {
        $departement = Departement::orderBy('id');
        return DataTables::of($departement)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->addColumn('parent', function ($row) {
               return $row->parent_id>0 ? $row->parent->name:'';
            })
            ->addColumn('link', function ($row) {
                return '<a class="btn editoffer"
                 data-ids = "' . $row->id . '"
                 data-kode = "' .  $row->kode . '"
                 data-name = "' .  $row->name . '"
                 data-parent_id = "' .  $row->parent_id . '"
            >
            <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })->rawColumns(['check', 'link','parent'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getDepartementById($id, $withchild = false)
    {
        try {
            if ($withchild) {
                $departement = Departement::with(str_repeat('children.', 99))->find($id);
            } else {
                $departement = Departement::with('parent')->find($id);
                $departement = [
                    'id' => $departement->id,
                    'kode' => $departement->kode_Departement,
                    'name' => $departement->name,
                    'parent' => ($departement->parent != null) ? $departement->parent->name : ''
                  ];
            }
            // Check the Departement
            if (!$departement) return $this->error("No Departement with ID $id", 404);

            return $this->success("Departement Detail", $departement);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestDepartement(DepartementRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            // If Departement exists when we find it
            // Then update the Departement
            // Else create the new one.
            $departement = $id ? Departement::find($id) : new Departement;

            // Check the Departement
            if ($id && !$departement) return $this->error("No Departement with ID $id", 404);

            $departement->name = $request->name;
            $departement->kode = $request->kode;
            $departement->parent_id = $request->parent_id ?? 0;

            // Save the Departement
            $departement->save();

            DB::commit();
            return $this->success(
                $id ? "Departement Berhasil Diupdate"
                    : "Departement Berhasil Disimpan",
                $departement,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 421);
        }
    }

    public function deleteDepartement(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
            Departement::whereIn('id', explode(",", $ids))->delete();
            DB::commit();

            return $this->success("Departement deleted", []);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 421);
        }
    }
}
