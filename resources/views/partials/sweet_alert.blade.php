@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Success...",
            text: "{{ session()->get('success') }}",
        });
    </script>
@elseif (session()->has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Error...",
            text: "{{ session()->get('error') }}",
        });
    </script>
@endif
