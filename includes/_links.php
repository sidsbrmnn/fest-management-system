<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://htmlstream.com/preview/front-v2.9.2/assets/css/theme.css"> -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

    .form-label {
        display: block;
        text-transform: uppercase;
        font-size: 80%;
        font-weight: 500;
    }

    .font-weight-semi-bold {
        font-weight: 600 !important;
    }

    .font-weight-medium {
        font-weight: 500 !important;
    }

    .btn {
        font-weight: 500;
        padding: 0.75rem 1rem;
    }

    .btn-sm {
        padding: 0.625rem 1.125rem;
    }

    .media {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .media-body {
        -ms-flex: 1;
        flex: 1;
    }

    .card-deck {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .content-centered-y {
        position: absolute;
        top: 50%;
        -webkit-transform: translate(0, -50%);
        transform: translate(0, -50%);
    }

    @media (min-width: 768px) {
        .content-centered-y--md {
            position: absolute;
            top: 50%;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }
    }

    @media (min-width: 992px) {
        .content-centered-y--lg {
            position: absolute;
            top: 50%;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }
    }

    .card-deck .card {
        margin-bottom: 15px;
    }

    .dropdown-item {
        font-size: 0.875rem;
    }

    .dropdown-item:hover {
        color: var(--primary);
        background-color: initial;
    }

    .dropdown-item.active {
        color: var(--primary);
        background-color: initial;
    }

    .dropdown-item-icon {
        display: inline-block;
        vertical-align: middle;
        text-align: center;
        font-size: 0.8125rem;
        min-width: 1rem;
        max-width: 1rem;
        margin-right: .5rem;
    }

    .btn-icon {
        position: relative;
        line-height: 0;
        font-size: 1rem;
        width: 3.125rem;
        height: 3.125rem;
        padding: 0;
    }

    .btn-icon.btn-sm {
        font-size: 0.8175rem;
        width: 2rem;
        height: 2rem;
    }

    .transition-3d-hover {
        transition: all 0.2s ease-in-out;
    }

    .transition-3d-hover:hover,
    .transition-3d-hover:focus {
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
    }

    @media (min-width: 576px) {
        .card-deck {
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .card-deck .card {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-right: 15px;
            margin-bottom: 0;
            margin-left: 15px;
        }
    }

    @media (min-width: 768px) {
        .w-md-75 {
            width: 75%;
        }
    }

    @media (min-width: 992px) {
        .w-lg-50 {
            width: 50%;
        }
    }

</style>
