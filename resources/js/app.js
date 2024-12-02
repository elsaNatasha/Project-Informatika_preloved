import "./bootstrap";
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            
            // Mengirim permintaan AJAX ke server
            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Mengirim token CSRF untuk proteksi
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => {
                console.log(response); // Tambahkan log untuk mengecek status response
                return response.json();
            })
            .then(data => {
                alert(data.message);  // Pesan sukses
                window.location.href = '{{ route('cart.index') }}';  // Arahkan ke halaman cart
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error adding the product to your cart.');
            });
        });
    });
});
