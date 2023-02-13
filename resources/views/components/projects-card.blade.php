<!-- projects -->

<div class="card mx-4 my-4">
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold mx-4 mt-4">All Projects</h4>
        </div>


        <div class="mx-2 mb-2">
        <table id="table" data-toggle="table" data-loading-template="loadingTemplate" data-url="/projects/list" data-icons-prefix="bx" data-icons="icons" data-show-refresh="true" data-total-field="total" data-data-field="rows" data-page-list="[2, 4, 10, All]" data-search="true" data-pagination-side="server" data-pagination="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="title">Title</th>
                        <th data-sortable="true" data-field="clients" data-formatter="clientFormatter">Clients</th>
                        <th data-sortable="true" data-field="users" data-formatter="userFormatter">Users</th>
                        <th data-sortable="true" data-field="status">Status</th>
                        <th data-formatter="actionFormatter">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    window.icons = {
        refresh: 'bx-refresh'
    }

    function loadingTemplate(message) {
        return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>'
    }

    function actionFormatter(value, row, index) {
        return [
            '<a href="/projects/edit/'+row.id+'">'+
            '<i class="bx bx-edit-alt mx-1">'+
            '</i>'+
            '</a>'+
            '<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#smallModal">'+
                                '<i class="bx bx-trash mx-1"></i>'+
                            '</button>'+


                            '<div class="modal fade" id="smallModal" tabindex="-1" style="display: none;" aria-hidden="true">'+
                                '<div class="modal-dialog modal-sm" role="document">'+
                                    '<div class="modal-content">'+
                                        '<div class="modal-header">'+
                                            '<h5 class="modal-title" id="exampleModalLabel2">Warning!</h5>'+
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">'+'</button>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            '<p>Are you sure you want to delete this project?</p>'+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">'+
                                                'Close'+
                                            '</button>'+
                                            '<a href="/projects/destroy/'+row.id+'">'+
                                                '<button type="submit" class="btn btn-primary">Yes</button>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                               '</div>'+
                            '</div>'
        ]
    }

    function clientFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">'+row.clients]
    }

    function userFormatter(value, row, index) {
        return ['<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">'+row.users]
    }
</script>

<!-- / projects -->