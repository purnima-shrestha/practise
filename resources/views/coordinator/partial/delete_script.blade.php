<script type="text/javascript">
     $('.delete-user').on('click', function (e) {
        e.preventDefault();
        swal({

          title: "Are you sure?",
          text: "You won't be able to revert this!!",
          icon: "warning",
          buttons: true,
          dangerMode: true,

        }).then((result) => {
            if (result) {
                   swal(
                      'Deleted!',
                      'User has been deleted.',
                      'success'
                    )
                  $(this).closest('form').submit();
            }
        })
    });
</script>