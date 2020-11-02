<div id="file-upload" class="section">
    <div class="row section">
        <div class="col-sm-6">
            @if($multiple)
            <span style="position: relative;top: 25px;">{{ $titleAttac }}.</span>
            <div class="input-field col-sm-6 float-right">
                <div class="btn waves-effect waves-light pink accent-2 white-text addAttac" data-name="{{ $name }}">Add File
                    <i class="material-icons right">add</i>
                </div>
            </div>
            @else
            <span >{{ $titleAttac }}.</span><br>
            @endif
        </div>
    </div>
    <div class="row section appendAttach{{ $name }}" style="max-height: 500px;overflow: scroll;">
        @if($record)
            <div class="col-sm-12 col-md-8  col-lg-12">
                <div class="form-group">
                    <input type="hidden" name="attachments[{{ $name }}][id][]" value="{{ $record->id }}">
                    <input type="file" name="attachments[{{ $name }}][value][]" id="input-file-max-fs" class="dropify" data-max-file-size="{{$size}}M" data-allowed-file-extensions="{{ $encypt }}" data-default-file="{{ ($record) ? $record->file : '' }}" data-show-remove="false"/>
                </div>
            </div>
        @elseif($records)
            @if(count($records) > 0)
                @foreach($records as $k => $value) 
                    <div class="col-sm-12 col-md-8  col-lg-4 cekAttach{{ $name }} dataPageAttach{{ $name }}{{ $k }}" data-length="{{ $k }}">
                        <div class="form-group">
                            <center>
                                <a class="btn-floating mb-1 waves-effect waves-light red deleteAttac" data-length="dataPageAttach{{ $name }}{{ $k }}" data-name="{{ $name }}" data-id="{{ $value->id }}">
                                    <i class="material-icons">clear</i>
                                </a>
                            </center>
                            <input type="hidden" name="attachments[{{ $name }}][id][]" value="{{ $value->id }}">
                            <input type="file" name="attachments[{{ $name }}][value][]" id="input-file-max-fs" class="dropify" data-max-file-size="{{$size}}M" data-allowed-file-extensions="{{ $encypt }}" data-default-file="{{ ($value) ? $value->file : '' }}" data-show-remove="false"/>
                        </div>
                    </div>
                @endforeach
            @endif
        @else
            @if(!$multiple)
                <div class="col-sm-12 col-md-8  col-lg-12">
                    <div class="form-group">
                        <input type="file" name="attachments[{{ $name }}][value][]" id="input-file-max-fs" class="dropify" data-max-file-size="{{$size}}M" data-allowed-file-extensions="{{ $encypt }}" />
                    </div>
                </div>
            @endif
        @endif
    </div>
    <div class="appendDelete">

    </div>
</div>

@section('page-script')
    <script type="text/javascript">
    $(document).on('click','.addAttac',function(){
        var name = $(this).data('name');
        var length = $('.cekAttach'+name).last().data('length') + 1;
        if(isNaN(length)) {
            var length = 0;
        }
        console.log('length',length)
        $(".appendAttach"+name).append(
            `<div class="col-sm-12 col-md-8  col-lg-4 cekAttach`+name+` dataPageAttach`+name+length+`" data-length="`+length+`">
                    <div class="form-group">
                        <center>
                            <a class="btn-floating mb-1 waves-effect waves-light red deleteAttac" data-length="dataPageAttach`+name+length+`">
                                <i class="material-icons">clear</i>
                            </a>
                        </center>
                        <input type="file" name="attachments[`+name+`][value][`+length+`]" id="input-file-max-fs" class="dropify" data-max-file-size="{{$size}}M" data-allowed-file-extensions="{{ $encypt }}" />
                    </div>
                </div>`
        );
        $('.dropify').dropify();
    });

    $(document).on('click','.deleteAttac',function(){
        var length = $(this).data('length');
        var name = $(this).data('name');
        var id = $(this).data('id');
        if(name){
            $('.appendDelete').append(`
                <input type="hidden" name="attachments_delete[`+name+`][]" value="`+id+`">
            `);
        }
        $('.'+length).remove();
    });
</script>
@endsection
