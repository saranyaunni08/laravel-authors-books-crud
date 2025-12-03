<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 Authors & Books Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto+Slab:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient">
    <div class="container-fluid py-4 px-lg-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="d-inline-block p-4 rounded-4 shadow-lg bg-white">
                    <h1 class="display-4 fw-bold text-gradient mb-2">
                        <i class="fas fa-book-open me-3"></i>Authors & Books Manager
                    </h1>
                    <p class="lead text-muted">Manage your authors and their literary works with ease</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-gradient-primary text-white py-4">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-user-edit me-2"></i>
                                <span id="formTitle">Add New Author</span>
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="authorForm" class="needs-validation" novalidate>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-primary">
                                        <i class="fas fa-user-circle me-1"></i> Author Details
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control form-control-lg" id="name" placeholder="Author Name" required>
                                                <label for="name" class="text-muted">Author Name <span class="text-danger">*</span></label>
                                                <div class="invalid-feedback">Please provide author's name</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control form-control-lg" id="email" placeholder="author@example.com" required>
                                                <label for="email" class="text-muted">Email Address <span class="text-danger">*</span></label>
                                                <div class="invalid-feedback">Please provide a valid email</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label fw-semibold text-primary">
                                            <i class="fas fa-book me-1"></i> Books Collection
                                        </label>
                                        <span class="badge bg-primary rounded-pill" id="bookCount">1 book</span>
                                    </div>
                                    
                                    <div id="booksContainer" class="mb-3">
                                        <div class="book-row card card-body border-primary border-2 mb-3 position-relative">
                                            <div class="row g-2">
                                                <div class="col-md-7">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control book-name" name="books[0][name]" placeholder="Book Title" required>
                                                        <label class="text-muted">Book Title <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" min="0.01" class="form-control book-price" name="books[0][price]" placeholder="29.99" required>
                                                        <label class="text-muted">Price (₹) <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-center">
                                                    <button type="button" class="btn btn-outline-danger btn-sm remove-book" disabled>
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="books[0][id]">
                                        </div>
                                    </div>

                                    <button type="button" id="addBook" class="btn btn-outline-primary w-100 py-2">
                                        <i class="fas fa-plus-circle me-2"></i>Add Another Book
                                    </button>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 pt-3 border-top">
                                    <button type="button" id="resetForm" class="btn btn-light btn-lg px-4">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                                        <i class="fas fa-save me-2"></i>Save Author
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-gradient-success text-white py-4">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-list-alt me-2"></i>Authors Directory
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search authors or books...">
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="h-100 d-flex align-items-center justify-content-md-end">
                                    <span class="text-muted me-3" id="totalAuthors">Loading...</span>
                                    <button class="btn btn-success btn-lg shadow-sm" onclick="table.ajax.reload()">
                                        <i class="fas fa-sync-alt me-2"></i>Refresh
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="authorsTable" class="table table-hover align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-light">
                                        <th class="py-3 ps-4">
                                            <i class="fas fa-hashtag text-primary"></i>
                                        </th>
                                        <th class="py-3">
                                            <i class="fas fa-user-tie me-2 text-primary"></i>Author
                                        </th>
                                        <th class="py-3">
                                            <i class="fas fa-envelope me-2 text-primary"></i>Email
                                        </th>
                                        <th class="py-3">
                                            <i class="fas fa-book me-2 text-primary"></i>Books
                                        </th>
                                        <th class="py-3 pe-4 text-end">
                                            <i class="fas fa-cogs me-2 text-primary"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    let bookIndex = 1;
    let table;

    $(document).ready(function () {
        table = $('#authorsTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '/api/authors',
                dataSrc: '',
                error: function () {
                    Swal.fire('Error', 'Unable to load authors data', 'error');
                }
            },
            columns: [
                { 
                    data: 'id',
                    className: 'ps-4 fw-semibold'
                },
                { 
                    data: 'name',
                    render: function (data) {
                        return `<div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary text-white me-3">
                                        ${data.charAt(0).toUpperCase()}
                                    </div>
                                    <span class="fw-semibold">${data}</span>
                                </div>`;
                    }
                },
                { 
                    data: 'email',
                    render: function (data) {
                        return `<a href="mailto:${data}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-2 text-muted"></i>${data}
                                </a>`;
                    }
                },
                {
                    data: 'books',
                    className: 'book-list',
                    render: function (data) {
                        if (!data || data.length === 0) {
                            return '<span class="badge bg-light text-muted">No books</span>';
                        }
                        let booksHtml = data.map(b => 
                            `<div class="book-item d-inline-block me-2 mb-1">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                    <i class="fas fa-bookmark me-1"></i>${b.name}
                                </span>
                                <small class="text-success fw-bold ms-1">₹${b.price}</small>
                            </div>`
                        ).join('');
                        return `<div class="d-flex flex-wrap">${booksHtml}</div>`;
                    }
                },
                {
                    data: null,
                    className: 'pe-4 text-end',
                    render: function (data) {
                        return `
                            <div class="btn-group btn-group-sm shadow-sm" role="group">
                                <button class="btn btn-outline-warning edit-btn" data-id="${data.id}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger delete-btn" data-id="${data.id}" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                emptyTable: '<div class="text-center py-5"><i class="fas fa-users fa-3x text-muted mb-3"></i><h5 class="text-muted">No authors found</h5></div>'
            },
            drawCallback: function () {
                $('#totalAuthors').html(`<i class="fas fa-users me-2"></i>${this.api().data().length} Authors`);
            }
        });

        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });

        $('#addBook').on('click', function () {
            const row = `
                <div class="book-row card card-body border-primary border-2 mb-3 position-relative">
                    <div class="row g-2">
                        <div class="col-md-7">
                            <div class="form-floating">
                                <input type="text" class="form-control book-name" name="books[${bookIndex}][name]" placeholder="Book Title" required>
                                <label class="text-muted">Book Title <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" step="0.01" min="0.01" class="form-control book-price" name="books[${bookIndex}][price]" placeholder="29.99" required>
                                <label class="text-muted">Price (₹) <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-book">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="books[${bookIndex}][id]">
                </div>`;
            $('#booksContainer').append(row);
            bookIndex++;
            updateBookCount();
        });

        $(document).on('click', '.remove-book', function () {
            if ($('.book-row').length > 1) {
                $(this).closest('.book-row').remove();
                updateBookCount();
            } else {
                Swal.fire('Attention', 'At least one book is required!', 'warning');
            }
        });

        $('#resetForm').on('click', function () {
            $('#authorForm')[0].reset();
            $('#authorId').val('');
            $('#formTitle').text('Add New Author');
            $('#booksContainer').html(getFirstBookRow());
            bookIndex = 1;
            updateBookCount();
            $('.is-invalid').removeClass('is-invalid');
            $('.book-name').first().focus();
        });

        $('#authorForm').on('submit', function (e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');

            const id = $('#authorId').val();
            const url = id ? `/api/authors/${id}` : '/api/authors';
            const method = id ? 'PUT' : 'POST';

            const formData = {
                name: $('#name').val().trim(),
                email: $('#email').val().trim(),
                books: []
            };

            let isValid = true;
            $('.book-row').each(function () {
                const bookName = $(this).find('.book-name').val().trim();
                const bookPrice = $(this).find('.book-price').val();
                const bookId = $(this).find('input[type="hidden"]').val();

                if (!bookName || !bookPrice || parseFloat(bookPrice) <= 0) {
                    isValid = false;
                    $(this).find('.book-name, .book-price').addClass('is-invalid');
                }

                formData.books.push({
                    id: bookId || null,
                    name: bookName,
                    price: parseFloat(bookPrice)
                });
            });

            if (!formData.name) {
                isValid = false;
                $('#name').addClass('is-invalid');
            }
            if (!formData.email || !/^\S+@\S+\.\S+$/.test(formData.email)) {
                isValid = false;
                $('#email').addClass('is-invalid');
            }

            if (!isValid) {
                Swal.fire('Validation Error', 'Please check all fields and try again', 'error');
                return;
            }

            $.ajax({
                url: url,
                method: method,
                contentType: 'application/json',
                data: JSON.stringify(formData),
                beforeSend: function () {
                    Swal.fire({
                        title: 'Processing...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (response) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: id ? 'Updated!' : 'Created!',
                        text: `Author ${id ? 'updated' : 'created'} successfully`,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    table.ajax.reload(null, false);
                    $('#resetForm').click();
                },
                error: function (xhr) {
                    Swal.close();
                    const errorMsg = xhr.responseJSON?.message || 'An error occurred. Please try again.';
                    Swal.fire('Error', errorMsg, 'error');
                }
            });
        });

        $(document).on('click', '.edit-btn', function () {
            const authorId = $(this).data('id');
            $.ajax({
                url: `/api/authors/${authorId}`,
                method: 'GET',
                success: function (author) {
                    $('#authorId').val(author.id);
                    $('#name').val(author.name);
                    $('#email').val(author.email);
                    $('#formTitle').text(`Edit ${author.name}`);

                    $('#booksContainer').empty();
                    bookIndex = 0;

                    author.books.forEach(book => {
                        const row = `
                            <div class="book-row card card-body border-primary border-2 mb-3 position-relative">
                                <div class="row g-2">
                                    <div class="col-md-7">
                                        <div class="form-floating">
                                            <input type="text" class="form-control book-name" name="books[${bookIndex}][name]" value="${book.name}" required>
                                            <label class="text-muted">Book Title <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" step="0.01" class="form-control book-price" name="books[${bookIndex}][price]" value="${book.price}" required>
                                            <label class="text-muted">Price (₹) <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-book">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="books[${bookIndex}][id]" value="${book.id}">
                            </div>`;
                        $('#booksContainer').append(row);
                        bookIndex++;
                    });

                    updateBookCount();
                    $('html, body').animate({ scrollTop: 0 }, 500);
                }
            });
        });

        $(document).on('click', '.delete-btn', function () {
            const authorId = $(this).data('id');
            Swal.fire({
                title: 'Confirm Delete',
                text: "This will permanently delete the author and all associated books!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/authors/${authorId}`,
                        method: 'DELETE',
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Author has been removed',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null, false);
                        }
                    });
                }
            });
        });
    });

    function getFirstBookRow() {
        return `
            <div class="book-row card card-body border-primary border-2 mb-3 position-relative">
                <div class="row g-2">
                    <div class="col-md-7">
                        <div class="form-floating">
                            <input type="text" class="form-control book-name" name="books[0][name]" placeholder="Book Title" required>
                            <label class="text-muted">Book Title <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" step="0.01" min="0.01" class="form-control book-price" name="books[0][price]" placeholder="29.99" required>
                            <label class="text-muted">Price (₹) <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-book" disabled>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="books[0][id]">
            </div>`;
    }

    function updateBookCount() {
        const count = $('.book-row').length;
        $('#bookCount').text(`${count} book${count !== 1 ? 's' : ''}`);
        if (count === 1) {
            $('.remove-book').first().prop('disabled', true);
        }
    }
    </script>

    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        min-height: 100vh;
    }

    .bg-gradient-primary {
        background: var(--primary-gradient) !important;
    }

    .bg-gradient-success {
        background: var(--success-gradient) !important;
    }

    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .book-row {
        transition: all 0.3s ease;
        background: rgba(102, 126, 234, 0.05);
    }

    .book-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .book-item {
        transition: all 0.2s ease;
    }

    .book-item:hover {
        transform: scale(1.05);
    }

    .btn {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-lg {
        padding: 0.75rem 2rem;
    }

    .form-control, .form-select {
        border-radius: 0.75rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    .form-floating>label {
        color: #6c757d;
    }

    .input-group-text {
        border-radius: 0.75rem 0 0 0.75rem;
        border: 2px solid #e9ecef;
        border-right: none;
    }

    #searchInput {
        border-left: none;
        border-radius: 0 0.75rem 0.75rem 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.08);
        transform: scale(1.005);
    }

    .sticky-top {
        z-index: 1000;
    }

    .card {
        border: none;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .badge {
        border-radius: 0.5rem;
        padding: 0.35em 0.65em;
        font-weight: 500;
    }

    #bookCount {
        font-size: 0.85rem;
    }

    .btn-outline-danger:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-group .btn {
        border-radius: 0.5rem;
        margin: 0 2px;
    }

    .book-list {
        max-width: 300px;
    }

    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }
        .btn-lg {
            padding: 0.5rem 1.5rem;
        }
    }
    </style>
</body>
</html>