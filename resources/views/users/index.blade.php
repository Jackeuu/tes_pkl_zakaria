@extends('master')
@section('konten')
    <div class="card">
        <div class="card-datatable text-nowrap">
            <div class="dt-container dt-bootstrap5 dt-empty-footer">
                <div class="row card-header flex-column flex-md-row pb-0">
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto ma-auto mt-0">
                        <h5 class="card-title mb-0 text-md-start text-center">Data Pengguna</h5>
                    </div>
                    <div
                        class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                    </div>
                </div>

                <!-- sampe dini krudnya -->
                <div class="row m-3 my-0 justify-content-between align-items-center mt-4">
                    <div class="d-md-flex align-items-center dt-layout-start col-md-auto me-auto mt-0">
                        <div class="dt-length d-flex align-items-center">
                            <label for="dt-length-0">Tampil</label>
                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                class="form-select ms-2" id="dt-length-0">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                        <div class="dt-search d-flex align-items-center">
                            <input type="search" class="form-control ms-4" id="dt-search-0" placeholder="Search"
                                aria-controls="DataTables_Table_0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-flex justify-content-between align-items-center dt-layout-full table-responsive">
                <div class="card table-responsive w-100 m-1">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>id users</th>
                                <th>Nama Toko</th>
                                <th>nama pengguna</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>KSR00{{ $u->id_users }}</td>
                                    <td>{{ $u->store_name }}</td>
                                    <td>{{ $u->name}}</td>
                                    <td>{{ $u->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mx-3 justify-content-between mt-2">
                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-0">
                    <div class="dt-info" aria-live="polite" id="DataTables_Table_0_info" role="status"></div>
                </div>
                <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                    <div class="dt-paging">
                        <nav aria-label="pagination">
                            <ul class="pagination">
                                <li class="dt-paging-button page-item disabled">
                                    <button class="page-link previous" role="link" type="button"
                                        aria-controls="DataTables_Table_0" aria-disabled="true" aria-label="Previous"
                                        data-dt-idx="previous" tabindex="-1">
                                        <i class="icon-base bx bx-chevron-left scaleX-n1-rtl icon-18px"></i>
                                    </button>
                                </li>
                                <li class="dt-paging-button page-item">
                                    <button class="page-link next" role="link" type="button"
                                        aria-controls="DataTables_Table_0" aria-label="Next" data-dt-idx="next">
                                        <i class="icon-base bx bx-chevron-right scaleX-n1-rtl icon-18px"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection