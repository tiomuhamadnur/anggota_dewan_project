<script>
    $('#deleteModal').on('show.bs.modal', function(e) {
        var url = $(e.relatedTarget).data('url');

        document.getElementById("deleteForm").action = url;
    });
</script>
<script>
    function exportExcel() {
        $('#datatable-excel').click();
        console.log('klik');
    }
</script>
<script>
    @if (session('notify'))
        swal("Yeheeey!", "{{ session('notify') ?? '-' }}", "success");
    @elseif (session('notifyerror'))
        swal("Ooopss!", "{{ session('notifyerror') ?? '-' }}", "error");
    @elseif ($errors->any())
        @php
            $messageError = implode('<br>', $errors->all());
        @endphp
        swal("Ooopss!", "{{ $messageError }}", "error");
    @endif
</script>