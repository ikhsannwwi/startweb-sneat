<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" id="searchNav" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ auth()->user() ? img_src(auth()->user()->profile->foto, 'profile') : template_administrator('assets/img/avatars/1.png') }}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('admin.profile', auth()->user() ? auth()->user()->kode : '') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user() ? img_src(auth()->user()->profile->foto, 'profile') : template_administrator('assets/img/avatars/1.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span
                                        class="fw-semibold d-block">{{ auth()->user() ? auth()->user()->name : '' }}</span>
                                    <small
                                        class="text-muted">{{ auth()->user() ? (auth()->user()->user_group ? auth()->user()->user_group->name : 'Moderator') : '' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('admin.profile', auth()->user() ? auth()->user()->kode : '') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span
                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<div class="container-xxl">
    <div class="row ml-3">
        <div class="col-lg-8 order-0">
            <div class="card" style="position: absolute!important; z-index:1; width:30%">
                <div class="d-flex align-items-end row">
                    <div id="searchResults">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#searchNav').on('keyup', function() {
                var searchText = $(this).val().trim()
                    .toLowerCase(); // Trim whitespace and convert to lowercase for case-insensitive comparison
                var dropdownMenu = $('#searchResults'); // Get the dropdown menu
                dropdownMenu.empty(); // Clear previous search results

                if ($(this).val().trim() ===
                    '') { // If search text is empty after trimming, display "No results found"
                    return; // Exit the function
                }

                $('.menu-search').each(function() {
                    var menuItemText = $(this).find('.menu-link').not('.menu-toggle').text()
                        .toLowerCase(); // Get the menu item text excluding those with class 'menu-toggle'
                    if (menuItemText.includes(
                            searchText)) { // Check if the menu item text includes the search text
                        var menuItemHref = $(this).find('.menu-link').attr(
                            'href'); // Get the href attribute of the menu-link
                        var menuItemHTML = '<a class="dropdown-item" href="' + menuItemHref + '">' +
                            $(this).find('.menu-link').not('.menu-toggle').text() +
                            '</a>'; // Create a dropdown item with the menu link text and href
                        dropdownMenu.append(
                            menuItemHTML); // Append the dropdown item to the dropdown menu
                    }
                });

                if (dropdownMenu.children().length === 0) { // If no search results found
                    dropdownMenu.append('<span class="dropdown-item-text">No results found</span>');
                }
            });
        });
    </script>
@endpush
