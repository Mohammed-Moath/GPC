@if(Session::has('m'))
    <?php $a = [];
        $a = session()->pull('m'); ?>
    <script>
        swal({
    type: "{{ $a[0] }}",
    title: "{{ $a[1] }}",
    confirmButtonText: "موافق"
    });
    </script>
@endif


@if(Session::has('x'))
    <?php $a = [];
        $a = session()->pull('x'); ?>
    <script>
      swal({
          type: 'warning',
          title: '{{ $a[0] }}',
          text: '{{ $a[1] }}',
          timer: 5000,
          showConfirmButton: false
        });
    </script>
@endif




