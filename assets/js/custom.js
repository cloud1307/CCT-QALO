/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

// $(document).ready(function () {
// 	$('#schoolForm').on('submit', function (e) {
// 		e.preventDefault();

// 		let formData = $(this).serialize();

// 		$.ajax({
// 			url: '../controller/employeeController.php?action=addSchool',
// 			type: 'POST',
// 			data: formData,
// 			success: function (response) {
// 				alert('School added successfully!');
// 				$('#modal_school').modal('hide');
// 				$('#schoolForm')[0].reset();
// 				location.reload(); // Reload table data (optional: use AJAX for dynamic)
// 			},
// 			error: function () {
// 				alert('Error adding position.');
// 			}
// 		});
// 	});
// });




$(document).ready(function () {
    $(document).on('change', '#province', function () {
        var provCode = $(this).val();
		console.log(provCode);
        $('#cityMun').html('<option value="">Loading...</option>');
        $('#barangay').html('<option value="">Select Barangay</option>');

        $.post('../ajax/addressHandler.php', {
            action: 'getCities',
            provCode: provCode
        }, function (data) {
            $('#cityMun').html('<option value="">Select City/Municipality</option>');
            $.each(data, function (index, city) {
                $('#cityMun').append('<option value="' + city.citymunCode + '">' + city.txtCityMunDesc + '</option>');
            });
        }, 'json');
    });

    $('#cityMun').on('change', function () {
        var cityMunCode = $(this).val();
        $('#barangay').html('<option value="">Loading...</option>');

        $.post('../ajax/addressHandler.php', {
            action: 'getBarangays',
            cityMunCode: cityMunCode
        }, function (data) {
            $('#barangay').html('<option value="">Select Barangay</option>');
            $.each(data, function (index, brgy) {
                $('#barangay').append('<option value="' + brgy.intBrgyID + '">' + brgy.txtBrgyDesc + '</option>');
            });
        }, 'json');
    });
});
// $(document).ready(function () {
//     $('#modal_school').on('hidden.bs.modal', function () {
//         location.reload(); // or use DataTables reload if applicable
//     });
// });

// $(document).ready(function () {
//     $('#schoolForm').on('submit', function (e) {
//         e.preventDefault();
//         //  Proceed with AJAX
//         let formData = $(this).serialize();
//         $.ajax({
//             url: '../controller/employeeController.php?action=addSchool',
//             type: 'POST',
//             data: formData,
//             success: function (response) {
//                 const res = JSON.parse(response);

//                 Swal.fire({
//                     icon: res.status,
//                     title: res.status.charAt(0).toUpperCase() + res.status.slice(1),
//                     text: res.message,
//                     showConfirmButton: res.status !== 'success',
//                     timer: res.status === 'success' ? 1500 : undefined
//                 });

//                 if (res.status === 'success') {
//                     $('#modal_school').modal('hide');
//                     $('#schoolForm')[0].reset();

//                     setTimeout(function () {
//                         location.reload();
//                     }, 1500);
//                 }
//             },
//             error: function () {
//                 Swal.fire({
//                     icon: res.status === "warning" ? "warning" : "error",
// 				    title: res.message                    
//                 });
//             }
//         });
//     });
// });


$(document).ready(function () {
    // Position Form
    handleAjaxFormSubmission('#positionForm', '../controller/employeeController.php?action=add', '#modal_position');
    // School Form
    handleAjaxFormSubmission('#schoolForm', '../controller/employeeController.php?action=addSchool', '#modal_school');

    //School Program Form
    handleAjaxFormSubmission('#schoolProgramForm', '../controller/employeeController.php?action=SchoolProgram', '#modal_school_program');

        // Optional: Reload on modal close
    $('#modal_position, #modal_school, #modal_school_program').on('hidden.bs.modal', function () {
        location.reload(); // Optional if using DataTables, use DataTables reload instead
    });
});

function handleAjaxFormSubmission(formSelector, actionUrl, modalSelector) {
    $(formSelector).on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            success: function (response) {
                const res = JSON.parse(response);

                Swal.fire({
                    icon: res.status,
                    title: res.status.charAt(0).toUpperCase() + res.status.slice(1),
                    text: res.message,
                    showConfirmButton: res.status !== 'success',
                    timer: res.status === 'success' ? 1500 : undefined
                });

                if (res.status === 'success') {
                    if (modalSelector) $(modalSelector).modal('hide');
                    $(formSelector)[0].reset();

                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Unexpected Error",
                    text: "Something went wrong while processing your request."
                });
            }
        });
    });
}

function openAddSchoolProgramModal(){
    document.getElementById("schoolProgramForm").reset();
    document.getElementById("school_program_id").value = "";
    document.querySelector("#modal-title-school-program").innerHTML = "<i class='ph-plus me-2'></i>Add School Program";

    const btn = document.getElementById("btn-save-school-program");
    btn.classList.remove("btn-warning", "btn-primary");
    btn.classList.add("btn-success");
    btn.innerText = "Add School Program";

    // Change modal header background
    const header = document.querySelector("#modal-header-school-program");
    header.classList.remove("bg-primary", "bg-warning", "bg-danger");
    header.classList.add("bg-success");

    new bootstrap.Modal(document.getElementById('modal_school_program')).show();
}

function openUpdateSchoolProgramModal(schProgid, schid, schProgram, progCode) {
    document.getElementById("schoolProgramForm").reset();
    document.getElementById("school_program_id").value = schProgid;
    document.querySelector("input[name='programDescription']").value = schProgram;
    document.querySelector("input[name='programCode']").value = progCode;
    document.getElementById('schoolProgram').value = schid; // SET category here
    document.querySelector("#modal-title-school-program").innerHTML = "<i class='ph-pencil me-2'></i>Update School Program";
    
    const btn = document.getElementById("btn-save-school-program");
    btn.classList.remove("btn-success", "btn-warning");
    btn.classList.add("btn-primary");
    btn.innerText = "Update School Program";;

     // Change modal header background
    const header = document.querySelector("#modal-header-school-program");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_school_program')).show();
}

function openAddPositionModal() {
    document.getElementById("positionForm").reset();
    document.getElementById("position_id").value = "";
    document.querySelector("modal-title").innerHTML = "<i class='ph-plus me-2'></i>Add Position";
    
    const btn = document.getElementById("btn-save");
    btn.classList.remove("btn-warning", "btn-primary");
    btn.classList.add("btn-success");
    btn.innerText = "Add Position";

    // Change modal header background
    const header = document.querySelector("#modal-header");
    header.classList.remove("bg-primary", "bg-warning", "bg-danger");
    header.classList.add("bg-success");

    new bootstrap.Modal(document.getElementById('modal_position')).show();
}

function openUpdatePositionModal(id, position) {
    document.getElementById("positionForm").reset();
    document.getElementById("position_id").value = id;
    document.querySelector("input[name='position']").value = position;
    document.querySelector("#modal-title").innerHTML = "<i class='ph-pencil me-2'></i>Update Position";
    
    const btn = document.getElementById("btn-save");
    btn.classList.remove("btn-success", "btn-warning");
    btn.classList.add("btn-primary");
    btn.innerText = "Update Position";;

     // Change modal header background
    const header = document.querySelector("#modal-header");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_position')).show();
}


function openAddSchoolModal() {
    document.getElementById("schoolForm").reset();
    document.getElementById("school_id").value = "";
    document.querySelector("modal-title").innerHTML = "<i class='ph-plus me-2'></i>Add School";
    
    const btn = document.getElementById("btn-save-school");
    btn.classList.remove("btn-warning", "btn-primary");
    btn.classList.add("btn-success");
    btn.innerText = "Add School";

    // Change modal header background
    const header = document.querySelector("#modal-header-school");
    header.classList.remove("bg-primary", "bg-warning", "bg-danger");
    header.classList.add("bg-success");

    new bootstrap.Modal(document.getElementById('modal_school')).show();
}

function openUpdateSchoolModal(schid, schName, schCode, category) {
    document.getElementById("schoolForm").reset();
    document.getElementById("school_id").value = schid;
    document.querySelector("input[name='schoolName']").value = schName;
    document.querySelector("input[name='schoolCodeName']").value = schCode;
    document.getElementById('deptCategory').value = category; // SET category here
    document.querySelector("#modal-title-school").innerHTML = "<i class='ph-pencil me-2'></i>Update School";
    
    const btn = document.getElementById("btn-save-school");
    btn.classList.remove("btn-success", "btn-warning");
    btn.classList.add("btn-primary");
    btn.innerText = "Update School";;

     // Change modal header background
    const header = document.querySelector("#modal-header-school");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_school')).show();
}

