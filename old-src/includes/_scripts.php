<footer class="py-5 text-muted text-center small">
    <p class="mb-1">&copy; 2019-2020 Fest Management</p>
</footer>

<script src="http://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous">
</script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/c379eeb1c2.js" crossorigin="anonymous">
</script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/appear.js"></script>
<script src="js/circles.min.js"></script>
<script src="js/hs.core.js"></script>
<script src="js/hs.malihu-scrollbar.js"></script>
<script src="js/hs.progress-bar.js"></script>
<script src="js/hs.chart-pie.js"></script>
<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            errorClass: 'invalid-feedback',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $.validator.addMethod("phoneIN", function(phone_number,
        element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number
                .length > 9 &&
                phone_number.match(/^([6-9]{1}\d{9}){1}?$/);
        }, "Please specify a valid phone number.");

        $('.toast').toast('show');
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));
        var items = $.HSCore.components.HSChartPie.init('.js-pie');
        var verticalProgressBars = $.HSCore.components.HSProgressBar
            .init('.js-vr-progress', {
                direction: 'vertical',
                indicatorSelector: '.js-vr-progress-bar'
            });
    });

</script>
