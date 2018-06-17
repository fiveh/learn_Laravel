<aside class="col-md-4 blog-sidebar">
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">
            This block about. Place for some text. Learn Laravel by Andrey.
        </p>
    </div>

        <div class="p-3">
            <h4 class="font-italic">Search by:</h4>
            <ol class="list-unstyled mb-0">

                @foreach($archives as $stats)
                    <li>
                        <a href="/?month={{ $stats['month'] }}&year={{ $stats['year'] }}">
                            {{ $stats['month'].' '.$stats['year'] }}
                        </a>
                    </li>
                @endforeach

            </ol>
        </div>

    <div class="p-3">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</aside><!-- /.blog-sidebar -->
