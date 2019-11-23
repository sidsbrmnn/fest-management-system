<footer class="py-5 text-muted text-center small">
    <p class="mb-1">&copy; 2019-2020 Fest Management</p>
</footer>

<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/c379eeb1c2.js" crossorigin="anonymous"></script>
<script src="js/appear.js"></script>
<script src="js/circles.min.js"></script>
<script src="js/hs.core.js"></script>
<script src="js/hs.chart-pie.js"></script>
<script>
    $(document).ready(function () {
        $('.toast').toast('show');
        var items = $.HSCore.components.HSChartPie.init('.js-pie');
    });

</script>
