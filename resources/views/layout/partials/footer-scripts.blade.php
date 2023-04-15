<div id="loader">
    <div class="spinner"></div>
</div>
<script>
    /* Add the JavaScript to show/hide the spinner here */
    window.addEventListener('load', function() {
        var loader = document.getElementById('loader');
        setTimeout(function() {
          loader.classList.add('hide');
        }, 300);
      });

    // default toastr
    @if (session()->has('success'))
        toastr.success("{{session()->get('success')}}");
    @endif
    @if (session()->has('error'))
        toastr.error("{{session()->get('error')}}");
    @endif
    @if (session()->has('info'))
        toastr.info("{{session()->get('info')}}");
    @endif
</script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


