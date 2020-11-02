<script>
$("#checkAll").click(function(){
    $('input[class=cb_element]:checkbox').not(this).prop('checked', this.checked);
});
</script>
