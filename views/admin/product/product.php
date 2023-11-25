<div class="pcoded-content bg-white mt-4 px-4" ">
    <h1 class="pt-4 fw-bold" style="font-weight: bold; padding: 0 30px; font-size: 30px;">Product Admin</h1>
    <?php
        use app\core\Application;

        if (Application::$app->session->getFlash('delete')) {
            ?>
                <div class="alert alert_success"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                    <span style="font-weight: bold; font-size: 16px;">success!</span>
                    <span style="font-weight: bold; font-size: 16px;"><?php echo Application::$app->session->getFlash('delete') ?></span>
                </div>
            <?php
        }
    ?>
    <div id="kt_app_content" class="app-content  flex-column-fluid " data-select2-id="select2-data-kt_app_content">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl " data-select2-id="select2-data-kt_app_content_container">
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header d-flex justify-content-between align-items-center py-4">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1" style="background-color: #F9F9F9; border-radius: 6px;">
                            <div class="h-100 px-2 mx-2" style="background-color:#F9F9F9; height:43px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input type="text" style="border-radius: 6px; width: 250px; height: 43px; background-color:#F9F9F9; border-color: #F9F9F9; color:75,86,117;" class="form-control form-control-solid w-250px ps-12" placeholder="Search Product">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar d-flex flex-row-fluid justify-content-end gap-5" data-select2-id="select2-data-121-0ehj">
                        <div class="mx-4">
                            <!--begin::Select2-->
                            <select style="width: 150px; padding:0.5rem 1rem; border-radius: 6px;" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--begin::Add product-->
                        <a href="/admin-addproduct" style="border-radius: 12px;" class="d-flex align-items-center btn-admin w-100 fw-bold btn btn-primary">
                            Add Product
                        </a>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_ecommerce_products_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.9px;">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1">
                                            </div>
                                        </th>
                                        <th class="min-w-200px sorting" style="width: 248.575px;">
                                            PRODUCT
                                        </th>
                                        <th class="text-end min-w-100px sorting" tabindex="0" rowspan="1" colspan="1" style="width: 125.412px;">
                                            ID
                                        </th>
                                        <th class="text-end min-w-100px sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 125.412px;">
                                            PRICE
                                        </th>
                                        <th class="text-end min-w-100px sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 125.412px;">
                                            Rating
                                        </th>
                                        <th class="text-end min-w-100px sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 125.412px;">
                                            Status
                                        </th>
                                        <th class="text-end min-w-70px sorting_disabled" rowspan="1" colspan="1"  style="width: 119.775px;">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <?php 
                                        foreach ($model as $key => $value) {
                                            extract($value);
                                            ?>
                                                <tr class="odd">
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="1">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="" class="symbol symbol-50px ">
                                                                <img style="height: 50px; border-radius: 12px;" src="<?php echo $product_image ?>" alt="">
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5 mx-4">
                                                                <!--begin::Title-->
                                                                <a href="" style="font-weight: bold;" class="fw-bold text-gray-800 text-hover-primary fs-5 fw-bold"><?php echo $product_name ?></a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">000<?php echo $product_id ?></span>
                                                    </td>
                                                    <td class="text-end pe-0"><?php echo $price ?>₫</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        1
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger"><?php echo $status ?></div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="d-flex text-end">
                                                        <a href="/admin-updateproduct?id=<?php echo $product_id ?>">
                                                            <button type="button" style="border-radius: 4px;" class="btn btn-primary px-4">
                                                                Sửa
                                                            </button>
                                                        </a>
                                                        <a class="px-2" href="/admin-deleteproduct?id=<?php echo $product_id ?>">
                                                            <button onclick="return confirm('Are you sure you want to delete?')" type="button" style="border-radius: 4px;" class="btn btn-primary px-4">
                                                                Xóa
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="dataTables_length" id="kt_ecommerce_products_table_length"><label><select name="kt_ecommerce_products_table_length" aria-controls="kt_ecommerce_products_table" class="form-select form-select-sm form-select-solid">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select></label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_products_table_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="kt_ecommerce_products_table_previous"><a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item next" id="kt_ecommerce_products_table_next"><a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="4" tabindex="0" class="page-link"><i class="next"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Content container-->
    </div>
</div>
<!--begin::Card body-->