<footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
    <div class="flex flex-col justify-center">
        <div class='space-x-8'>
            <a class="text-gray-500 dark:text-white hover:text-yellow-500" href="">About Us</a>
            <a class="text-gray-500 dark:text-white hover:text-yellow-500" href="">Help</a>
            <a class="text-gray-500 dark:text-white hover:text-yellow-500" href="">Login</a>
            <a class="text-gray-500 dark:text-white hover:text-yellow-500" href="">Explore</a>
        </div>
        <div class='mt-2'>
            <span class='dark:text-white'>
                Copyright &copy;
                @if (date('Y') != '2020')
                {{ date('Y') }}
                @endif
                &nbsp; All rights reserved • by
                <a href="" target="_blank">Saryoni</a>.
            </span>
        </div>
    </div>
</footer>
