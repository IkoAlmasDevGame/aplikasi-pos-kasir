<!-- Vendor JS Files -->
<script src="<?=base('dist/vendor/apexcharts/apexcharts.min.js')?>"></script>
<script src="<?=base('dist/vendor/chart.js/chart.umd.js')?>"></script>
<script src="<?=base('dist/vendor/echarts/echarts.min.js')?>"></script>
<script src="<?=base('dist/vendor/quill/quill.js')?>"></script>
<script src="<?=base('dist/vendor/simple-datatables/simple-datatables.js')?>"></script>
<script src="<?=base('dist/vendor/tinymce/tinymce.min.js')?>"></script>
<script src="<?=base('dist/vendor/php-email-form/validate.js')?>"></script>

<!-- Template Main JS File -->
<script src="<?=base('dist/js/main.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
new DataTable('#example1', {
        search: {
            return: true,
        },
    },
    $(document).ready(function() {
        $('#example1_filter').hide(true)
    }),
);

new DataTable('#example2', {
    search: {
        return: false,
    },
});

$(document).ready(function() {
    var response = '';
    $("#cari").change(function() {
        $.ajax({
            type: "POST",
            url: "../kasir/get_barang.php?cari=yes",
            data: 'keyword=' + $(this).val(),
            async: false,
            beforeSend: function(response) {
                $("#hasil_cari").hide();
                $("#tunggu").html(
                    '<p style="color:green"><blink>tunggu sebentar</blink></p>');
            },
            success: function(html, response) {
                $("#tunggu").html('');
                $("#hasil_cari").show();
                $("#hasil_cari").html(html);
            }
        });
        return response;
    });
});

function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); // Free memory
        };
    }
}
</script>
</body>

</html>