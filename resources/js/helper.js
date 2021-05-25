$(document).on("show.bs.modal", "#city_delete_modal", function(event) {
    var button = $(event.relatedTarget);

    var city_id = button.data("cityid");
    var city_name = button.data("cityname");
    var modal = $(this);

    modal.find(".modal-body #city_id").val(city_id);
    modal.find(".modal-body #city_name").html(city_name);
});

$(document).on("show.bs.modal", "#city_edit_modal", function(event) {
    var button = $(event.relatedTarget);

    var city_name = button.data("cityname");
    var city_id = button.data("cityid");
    var modal = $(this);

    modal.find(".modal-body #city_name").val(city_name);
    modal.find(".modal-body #city_id").val(city_id);
});

// district
$(document).on("show.bs.modal", "#district_delete_modal", function(event) {
    var button = $(event.relatedTarget);

    var district_id = button.data("districtid");
    var district_name = button.data("districtname");
    var modal = $(this);

    modal.find(".modal-body #district_id").val(district_id);
    modal.find(".modal-body #district_name").html(district_name);
});

$(document).on("show.bs.modal", "#district_edit_modal", function(event) {
    var button = $(event.relatedTarget);

    var district_name = button.data("districtname");
    var district_id = button.data("districtid");
    var modal = $(this);

    modal.find(".modal-body #district_name").val(district_name);
    modal.find(".modal-body #district_id").val(district_id);
});

// subdistrict
$(document).on("show.bs.modal", "#subdistrict_delete_modal", function(event) {
    var button = $(event.relatedTarget);

    var subdistrict_id = button.data("subdistrictid");
    var subdistrict_name = button.data("subdistrictname");
    var modal = $(this);

    modal.find(".modal-body #subdistrict_id").val(subdistrict_id);
    modal.find(".modal-body #subdistrict_name").html(subdistrict_name);
});

$(document).on("show.bs.modal", "#subdistrict_edit_modal", function(event) {
    var button = $(event.relatedTarget);

    var subdistrict_name = button.data("subdistrictname");
    var subdistrict_id = button.data("subdistrictid");
    var modal = $(this);

    modal.find(".modal-body #subdistrict_name").val(subdistrict_name);
    modal.find(".modal-body #subdistrict_id").val(subdistrict_id);
});

$(document).on("show.bs.modal", "#product_delete_modal", function(event) {
    var button = $(event.relatedTarget);

    var product_id = button.data("productid");
    var modal = $(this);

    modal.find(".modal-body #product_id").val(product_id);
    modal.find(".modal-body #product_name").html(product_id);
});

$(document).on("show.bs.modal", "#product_registration_delete_modal", function(
    event
) {
    var button = $(event.relatedTarget);

    var product_registration_id = button.data("productregistrationid");
    var modal = $(this);

    modal
        .find(".modal-body #product_registration_id")
        .val(product_registration_id);
    modal
        .find(".modal-body #product_registration_name")
        .html(product_registration_id);
});

$(document).ready(function() {
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    // Add active state to sidbar nav links
    var path = window.location.pathname.split("/")[2] || "dashboard";
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.pathname.split("/")[2] === path) {
            $(this).addClass("active");
        } else {
            if (!this.pathname.split("/")[2] && path === "dashboard") {
                $(this).addClass("active");
            }
        }
    });

    $mongolia = {
        sEmptyTable: "Хүснэгт хоосон байна",
        sInfo: "Нийт _TOTAL_ бичлэгээс _START_ - _END_ харуулж байна",
        sInfoEmpty: "Тохирох үр дүн алга",
        sInfoFiltered: "(нийт _MAX_ бичлэгээс шүүв)",
        sInfoPostFix: "",
        sInfoThousands: ",",
        sLengthMenu: "Дэлгэцэд _MENU_ бичлэг харуулна",
        sLoadingRecords: "Ачааллаж байна...",
        sProcessing: "Боловсруулж байна...",
        sSearch: "Хайлт:",
        sZeroRecords: "Тохирох бичлэг олдсонгүй",
        oPaginate: {
            sFirst: "Эхнийх",
            sLast: "Сүүлийнх",
            sNext: "Дараах",
            sPrevious: "Өмнөх"
        },
        oAria: {
            sSortAscending: ": цагаан толгойн дарааллаар эрэмбэлэх",
            sSortDescending: ": цагаан толгойн эсрэг дарааллаар эрэмбэлэх"
        }
    };

    // Initialize products datatable
    $("#products-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/products",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "id", name: "id" },
            {
                data: "image",
                name: "image",
                render: function(data) {
                    return '<img src="' + data + '" width=50 />';
                }
            },
            { data: "product_name", name: "product_name" },
            { data: "product_type_id", name: "product_type_id" },
            { data: "description", name: "description" },
            { data: "price", name: "price" },
            { data: "quantity", name: "quantity" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize employees datatable
    $("#employees-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/employees",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "last_name", name: "last_name" },
            { data: "first_name", name: "first_name" },
            { data: "email", name: "email" },
            { data: "mobile_number", name: "mobile_number" },
            { data: "employee_type_id", name: "employee_type_id" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize product registration datatable
    $("#product-registration-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/product-registration",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "id", name: "id" },
            { data: "product_id", name: "product_id" },
            { data: "quantity", name: "quantity" },
            { data: "employee_id", name: "employee_id" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize orders datatable
    $("#orders-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/orders",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "order_id", name: "order_id" },
            { data: "order_status_id", name: "order_status_id" },
            { data: "user_id", name: "user_id" },
            { data: "basket_id", name: "basket_id" },
            { data: "address_id", name: "address_id" },
            { data: "amount", name: "amount" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize orders datatable
    $("#cities-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/address",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "city_id", name: "city_id" },
            { data: "city_name", name: "city_name" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize orders datatable
    $("#districts-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/address/{}/districts",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "district_id", name: "district_id" },
            { data: "city_id", name: "city_id" },
            { data: "district_name", name: "district_name" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize orders datatable
    $("#subdistricts-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/address/{}/subdistricts",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "subdistrict_id", name: "subdistrict_id" },
            { data: "district_id", name: "district_id" },
            { data: "subdistrict_name", name: "subdistrict_name" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize orders datatable
    $("#shipments-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/shipments",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "order_status", name: "order_status" },
            { data: "id", name: "id" },
            { data: "order_id", name: "order_id" },
            { data: "shipper_id", name: "shipper_id" },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" }
        ]
    });

    // Initialize product registration datatable
    $("#users-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/users",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "last_name", name: "last_name" },
            { data: "first_name", name: "first_name" },
            { data: "email", name: "email" },
            { data: "mobile_number", name: "mobile_number" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize basket datatable
    $("#baskets-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/baskets",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "id", name: "id" },
            { data: "user_id", name: "user_id" },
            { data: "total", name: "total" },
            { data: "created_at", name: "created_at" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ]
    });

    // Initialize packaging report datatable
    $("#packaging-report-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/reports/packaging-report",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "clerk_id", name: "clerk_id" },
            { data: "first_name", name: "first_name" },
            { data: "last_name", name: "last_name" },
            { data: "total", name: "total" },
            { data: "packaging_count", name: "packaging_count" }
        ]
    });

    // Initialize packaging report datatable
    $("#shipment-report-table").DataTable({
        processing: true,
        serverSide: true,
        language: $mongolia,
        ajax: "/dashboard/reports/shipment-report",
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "shipper_id", name: "shipper_id" },
            { data: "first_name", name: "first_name" },
            { data: "last_name", name: "last_name" },
            { data: "shipment_count", name: "shipment_count" }
        ]
    });
});
