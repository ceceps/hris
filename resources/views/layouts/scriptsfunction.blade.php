<script>
    if($('.js-switch').length){
       var elem = document.querySelector('.js-switch');
       var init = new Switchery(elem, { size: 'small' });
    }

    function progress(e) {
        if (e.lengthComputable) {
            var max = e.total;
            var current = e.loaded;
            var percentage = (current * 100) / max;
            $('.progress-bar-emrald').css('width', percentage + '%').attr('aria-valuenow', percentage);
            if (percentage == 100) {
                swal("Tunggu!", "Sedang diproses....", {
                    icon: "warning",
                });
            }
        }
    }

    function nestedOption(result, level = 0) {
        let options = '';
        let strip = '--';
        for (let x = 0; x < result.length; x++) {
            let text = (level > 0) ? strip.repeat(level) + " " +
                result[x].name : result[x].name;
            options += '<option value="' + result[x].id + '">' + text + '</option>';

            if (result[x].children != null) {
                options += nestedOption(result[x].children, Number(level) + 1);
            }
        }
        return options;
    }

    function loadOptionParent(url,elem,setid='') {
        $.getJSON(url, function(data) {
            let options = '';
            if (data != null) {
                $('#'+elem).find('option').not(':first').remove();
                let result = data.results;
                options += nestedOption(result);
                $('#'+elem).append(options);

                if(setid !==''){
                  $('#'+elem).val(setid).trigger('change');
                }
            }
        });
    }

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function realNumber(string){
        string = (string != '') ? string.slice(0,string.length - 3):'0';
        return string.split('.').join("");
    }

    function formatCurrency(input, blur) {
        var input_val = input.val();
        if (input_val === "") {
            return;
        }
        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");
        if (input_val.indexOf(",") >= 0) {
            var decimal_pos = input_val.indexOf(",");
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);
            left_side = formatNumber(left_side);
            right_side = formatNumber(right_side);
            if (blur === "blur") {
                right_side += "00";
            }
            right_side = right_side.substring(0, 2);
            input_val = "Rp. " + left_side + "," + right_side;
        } else {
            input_val = formatNumber(input_val);
            input_val = "Rp. " + input_val;

            if (blur === "blur") {
                input_val += ",00";
            }
        }

        input.val(input_val);
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    function tglYmdToDmy(tgl) {
        let splitTgl = tgl.split('-');
        return splitTgl[2] + "-" + splitTgl[1] + "-" + splitTgl[0];
    }

    function hurufBesarAwal(str) {
        return str.replace(/\w\S*/g,
            function(a) {
                return a.charAt(0).toUpperCase() + a.substr(1).toLowerCase();
            });
    }

    function filePreview(input, idpreview, resize) {
       if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + idpreview).attr('src', e.target.result).attr('width', resize);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // window.dataLayer = window.dataLayer || [];
    // function gtag(){dataLayer.push(arguments);}
    // gtag('js', new Date());

    // gtag('config', 'UA-23581568-13');
</script>
