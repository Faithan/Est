<div class="logout-container">
    <a href="#" id="logoutLink"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
</div>


<script>
    document.getElementById('logoutLink').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log out!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to the logout page
                window.location.href = 'logout.php'; // Replace with your logout URL
            }
        });
    });
</script>