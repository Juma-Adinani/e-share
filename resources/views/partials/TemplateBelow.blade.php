</div>
@include('partials._footer')
</div>
</div>
</div>
<style>
    a:hover {
        text-decoration: none;
    }
</style>
@include('partials._script_tag')
<script>
    $(document).ready(function() {
        $("#search-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".school-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</body>

</html>
