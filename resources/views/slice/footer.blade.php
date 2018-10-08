
<script>
    if(window.jQuery) {
        $(document).ready(function(){
          $('.dropdown a.dropdown-toggle').on("click", function(e){
            console.log('it is here');
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
        });
    }
</script>

<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>

<!--
    Powered by SliceCMS
    (c){{ date("Y") }} Benjamin Hansen. All Rights Reserved.
-->
