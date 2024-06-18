
    function confirmDelete() {
        Swal.fire({
            title: 'Reject Confirmation',
            text: 'Are you sure you want reject this reservation?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteItem();
            }
        });
    }

    function deleteItem() {
        var reserve_id = document.querySelector('input[name="reserved_id"]').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../reject.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    Swal.fire({
                        title: 'Rejected Successfully',
                        text: 'reservation rejected successfully.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '../reservation.php'; // Replace with your desired page after deletion
                    });
                } else {
                    Swal.fire({
                        title: 'Delete Error',
                        text: 'Failed to reject this reservation.',
                        icon: 'error'
                    });
                }
            }
        };
        xhr.send('reserve_id=' + reserve_id);
    }
