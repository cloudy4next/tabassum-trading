@php use Carbon\Carbon; @endphp
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        <strong> IceAxe </strong>
    </div>
    <!-- Default to the left -->
        <strong>Copyright &copy; 2014-{{ Carbon::now()->format('Y') }} <a
            href="tel:01712020833">{{ env('APP_NAME') }}</a>.</strong> All rights
        reserved.
</footer>
