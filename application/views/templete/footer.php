</div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= base_url('assets/admin'); ?>/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url('assets/admin'); ?>/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="<?= base_url('assets/admin'); ?>/vendor/chart.js/dist/Chart.extension.js"></script>

<!-- Argon JS -->
<script src="<?= base_url('assets/admin'); ?>/js/argon.js?v=1.2.0"></script>
<script src="<?= base_url('assets/admin/vendor/bootstrap-datepicker/dist/js'); ?>/bootstrap-datepicker.min.js"></script>

<script>
    $('.costum-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.costume-file-label').addClass("selected").html(fileName);
    })

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('dashboard/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('dashboard/roleaccess/'); ?>" + roleId;
            }
        });
    });

    $('.form-check-input1').on('click', function() {
        const userId = $(this).data('user');
        const date = $(this).data('date');

        $.ajax({
            url: "<?= base_url('dashboard/p_absentmanual'); ?>",
            type: 'post',
            data: {
                userId: userId,
                date: date
            },
            success: function() {
                document.location.href = "<?= base_url('dashboard/absentmanual/'); ?>";
            }
        });
    });

    $('.form-check-input2').on('click', function() {
        const userId = $(this).data('user');
        const groupId = $(this).data('group');

        $.ajax({
            url: "<?= base_url('dashboard/p_invite_group'); ?>",
            type: 'post',
            data: {
                userId: userId,
                groupId: groupId
            },
            success: function() {
                document.location.href = "<?= base_url('dashboard/invite_group/'); ?>" + groupId;
            }
        });
    });

    // ajax untuk live checklist yang dikirimkan kedalam method changeaccess
</script>
</body>

</html>