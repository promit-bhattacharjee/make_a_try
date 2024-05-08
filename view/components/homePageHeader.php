<style>
    .carousel-indicators li,
    .carousel-control-prev-icon,
    .carousel-control-next-icon {

        background-color: #000 !important;
        /* Set the background color to dark */
        border-color: #000 !important;
        /* Set the border color to dark */
    }

    .carousel-indicators .active {
        background-color: #fff !important;
        /* Set the active indicator background color to light */
    }

    #header {
  transform: translateY(-100%);
  transition: transform 1s ease-in-out;
}

#header.active {
  transform: translateY(0%);
}
.modal-backdrop{
    position: static !important;
    top: 0 !important;
  }
</style>
<script>
        document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("header").classList.add("active");
  });
  </script>
  
  <?php include("../components/DomHeader.php")
    ?>