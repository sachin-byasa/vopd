
    function deleteconfirm(urlredirect){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to Recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
 
              window.location.href = BASE_URL + urlredirect;
            } else {

            }
          });
            return false;
    }

    function activateconfirm(urlredirect){
      swal({
        title: "Are you sure?",
        text: "You want to Activate?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          window.location.href = BASE_URL + urlredirect;
        } else {

        }
      });
        return false;
    }