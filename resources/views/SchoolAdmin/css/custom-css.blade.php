<style>

    body { height: 100vh; overflow: hidden; }
    .w-sidebar { width: 200px; max-width: 200px; }

    .row.collapse {
        margin-left: -200px;
        left: 0;
        transition: margin-left .15s linear;
    }

    .row.collapse.show {
        margin-left: 0 !important;
    }

    .row.collapsing {
        margin-left: -200px;
        left: -0.05%;
        transition: all .15s linear;
    }

    ul ul a {
        font-size: 0.9rem !important;
        padding-left: 30px !important;
    }
    ul li a{
        font-size: 1.1em !important;
    }
    .sidebar
    {
        background-color: #33C5FF;
        border-top-right-radius: 10px;
    }
    .sidebar a{
        font-weight: 400;
            color: white
    }
    .header{
        background-color: #33C5FF;
    }
    .sidebar a:hover, .sidebar a:focus {
            background-color: #00B6FF;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar ul li .active{
            background-color: #00B6FF;
        }
        .header-info-icons
        {
            margin-right: 5px;
        }
        .header-info-icons a{
            padding: 0px 10px;
        }
        .navbar-brand
        {
            /* font-family: poppins; */
            color: white;
            margin-left:15px;
            font-size: 1.5rem;
        }
    @media (max-width:768px) {

        .row.collapse,
        .row.collapsing {
            margin-left: 0 !important;
            left: 0 !important;
            overflow: visible;
        }

        .row > .sidebar.collapse {
            display: flex !important;
            margin-left: -100% !important;
            transition: all .3s linear;
            position: fixed;
            z-index: 1050;
            max-width: 0;
            min-width: 0;
            flex-basis: auto;
        }

        .row > .sidebar.collapse.show {
            margin-left: 0 !important;
            width: 100%;
            max-width: 60%;
            min-width: initial;
        }

        .row > .sidebar.collapsing {
            display: flex !important;
            margin-left: -10% !important;
            transition: all .3s linear !important;
            position: fixed;
            z-index: 1050;
            min-width: initial;
        }

    }
    .content-main-outer{ padding-bottom:100px !important; }
</style>
