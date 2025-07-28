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

    //Major Program Form
    handleAjaxFormSubmission('#majorProgramForm', '../controller/employeeController.php?action=MajorProgram', '#modal_major_course');

    //Board Resolution Form
    handleAjaxFormSubmission('#boardResolutionForm', '../controller/employeeController.php?action=BoardResolution', '#modal_board_resolution');

    //Academic Resolution Form
    handleAjaxFormSubmission('#academicResolutionForm', '../controller/employeeController.php?action=AcademicResolution', '#modal_academic_resolution');

        // Optional: Reload on modal close
    $('#modal_position, #modal_school, #modal_school_program, #modal_major_course, #modal_board_resolution, #modal_academic_resolution').on('hidden.bs.modal', function () {
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

function openAddMajorProgramModal(){
    document.getElementById("majorProgramForm").reset();
    document.getElementById("major_program_id").value = "";
    document.querySelector("#modal-title-major-program").innerHTML = "<i class='ph-plus me-2'></i>Add Major Program";

    const btn = document.getElementById("btn-save-major-program");
    btn.classList.remove("btn-warning", "btn-primary");
    btn.classList.add("btn-success");
    btn.innerText = "Add Major Program";

    // Change modal header background
    const header = document.querySelector("#modal-header-major-program");
    header.classList.remove("bg-primary", "bg-warning", "bg-danger");
    header.classList.add("bg-success");

    new bootstrap.Modal(document.getElementById('modal_major_course')).show();
}

function openUpdateMajorProgramModal(majorid, progid, majorcourse) {
    document.getElementById("majorProgramForm").reset();
    document.getElementById("major_program_id").value = majorid;
    document.querySelector("input[name='majorProgram']").value = majorcourse;
    document.getElementById('ProgramDescription').value = progid;
    document.querySelector("#modal-title-major-program").innerHTML = "<i class='ph-pencil me-2'></i>Update Major Program";
    
    const btn = document.getElementById("btn-save-major-program");
    btn.classList.remove("btn-success", "btn-warning");
    btn.classList.add("btn-primary");
    btn.innerText = "Update Major Program";

     // Change modal header background
    const header = document.querySelector("#modal-header-major-program");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_major_course')).show();
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
    btn.innerText = "Update School Program";

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
    btn.innerText = "Update Position";

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
    btn.innerText = "Update School";

     // Change modal header background
    const header = document.querySelector("#modal-header-school");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_school')).show();
}



///modal optimize openmodal
function openModal(config) {
    // Reset the form
    document.getElementById(config.formId).reset();

    // Set ID if provided
    if (config.idField && config.idValue !== undefined) {
        document.getElementById(config.idField).value = config.idValue;
    }

    // Set other form fields
    if (config.fields && typeof config.fields === "object") {
        for (const [selector, value] of Object.entries(config.fields)) {
            const input = document.querySelector(selector);
            if (input) input.value = value;
        }
    }

    // Set modal title
    const titleEl = document.querySelector(`#${config.titleId}`);
    if (titleEl) {
        titleEl.innerHTML = `${config.icon} ${config.title}`;
    }

    // Set button appearance and label
    const btn = document.getElementById(config.buttonId);
    if (btn) {
        btn.className = `btn ${config.buttonClass}`;
        btn.innerText = config.buttonText;
    }

    // Set modal header class
    const header = document.getElementById(config.headerId);
    if (header) {
        header.className = `modal-header ${config.headerClass} text-white border-0`;
    }

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById(config.modalId));
    modal.show();
}


function openAddBoardResolutionModal() {
    openModal({
        formId: "boardResolutionForm",
        idField: "board_resolution_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-board-resolution",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add Board Resolution",
        buttonId: "btn-save",
        buttonText: "Add Board Resolution",
        buttonClass: "btn-success",
        headerId: "modal-header",
        headerClass: "bg-success",
        modalId: "modal_board_resolution"
    });
}

// function openUpdateBoardResolutionModal(boardResolution, boardResolutionCode, boardResolutionYear, boardResolutionID) {
//     openModal({
//         formId: "boardResolutionForm",
//         idField: "board_resolution_id",
//         idValue: boardResolutionID,
//         fields: {
//             "input[name='boardResolution']": boardResolution,
//             "input[name='resolutionCode']": boardResolutionCode,
//             "input[name='resolutionYear']": boardResolutionYear
//         },
//         titleId: "modal-title-board-resolution",
//         icon: "<i class='ph-pencil me-2'></i>",
//         title: "Update Board Resolution",
//         buttonId: "btn-save-board-resolution",
//         buttonText: "Update Board Resolution",
//         buttonClass: "btn-primary",
//         headerId: "modal-header-board-resolution",
//         headerClass: "bg-primary",
//         modalId: "modal_board_resolution"
//     });
// }

function openAddAcademicResolutionModal() {
    openModal({
        formId: "academicResolutionForm",
        idField: "academic_resolution_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-academic-resolution",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add Academic Resolution",
        buttonId: "btn-save",
        buttonText: "Add Academic Resolution",
        buttonClass: "btn-success",
        headerId: "modal-header-academic-resolution",
        headerClass: "bg-success",
        modalId: "modal_academic_resolution"
    });
}


function openUpdateAcademicResolutionModal(academicResolution, academicResolutionCode, academicResolutionYear, academicResolutionID) {
    openModal({
        formId: "academicResolutionForm",
        idField: "academic_resolution_id",
        idValue: academicResolutionID,
        fields: {
            "input[name='academicResolution']": academicResolution,
            "input[name='academicresolutionCode']": academicResolutionCode,
            "input[name='academicResolutionYear']": academicResolutionYear
        },
        titleId: "modal-title-academic-resolution",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Academic Resolution",
        buttonId: "btn-save-academic-resolution",
        buttonText: "Update Academic Resolution",
        buttonClass: "btn-primary",
        headerId: "modal-header-board-resolution",
        headerClass: "bg-primary",
        modalId: "modal_academic_resolution"
    });
}

function openUpdateBoardResolutionModal(boardResolution, boardResolutionCode, boardResolutionYear, boardResolutionID) {
    document.getElementById("boardResolutionForm").reset();
    document.getElementById("board_resolution_id").value = boardResolutionID;
    document.querySelector("input[name='boardResolution']").value = boardResolution;
    document.querySelector("input[name='resolutionCode']").value = boardResolutionCode;
    document.querySelector("input[name='resolutionYear']").value = boardResolutionYear;
    document.querySelector("#modal-title-board-resolution").innerHTML = "<i class='ph-pencil me-2'></i>Update Board Resolution";
    
    const btn = document.getElementById("btn-save-board-resolution");
    btn.classList.remove("btn-success", "btn-warning");
    btn.classList.add("btn-primary");
    btn.innerText = "Update Board Resolution";

     // Change modal header background
    const header = document.querySelector("#modal-header-board-resolution");
    header.classList.remove("bg-success", "bg-warning", "bg-danger");
    header.classList.add("bg-primary");
    new bootstrap.Modal(document.getElementById('modal_board_resolution')).show();
}

