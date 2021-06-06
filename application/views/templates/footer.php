    <!-- HueBee -->
    <script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>    
    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.6/sweetalert2.min.js" integrity="sha512-CrNI25BFwyQ47q3MiZbfATg0ZoG6zuNh2ANn/WjyqvN4ShWfwPeoCOi9pjmX4DoNioMQ5gPcphKKF+oVz3UjRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <!-- Main JS -->
    <script src="<?= base_url().'assets/js/main.js' ?>"></script>

    <?php 
        if(isset($_SESSION['swal'])) {            
    ?>
        <script>
            swal();
        </script>
    <?php } ?>

</body>
</html>