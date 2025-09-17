/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

//sweet alert for file upload
// $('.resolution-form').on('submit', function (e) {
//     e.preventDefault();
    
//     const $form = $(this);
//     const formData = new FormData(this);
//     const action = $form.data('action'); // e.g., 'BoardResolution' or 'AcademicResolution'

//     $.ajax({
//         url: '../controller/employeeController.php?action=' + action,
//         type: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             let res;
//             try {
//                 res = JSON.parse(response);
//             } catch (e) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Unexpected Error',
//                     text: 'Could not parse server response.'
//                 });
//                 return;
//             }

//             Swal.fire({
//                 icon: res.status === 'success' ? 'success' : 'error',
//                 title: res.status === 'success' ? 'Success' : 'Error',
//                 text: res.message
//             }).then(() => {
//                 if (res.status === 'success') {
//                     $form[0].reset();
//                     $('.modal').modal('hide');
//                     // Optionally reload table or data
//                 }
//             });
//         },
//         error: function () {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'AJAX Error',
//                 text: 'Something went wrong during the request.'
//             });
//         }
//     });
// });

//-sweet alert for file upload

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


$(document).ready(function () {
    const forms = [
        { id: '#positionForm', action: 'add', modal: '#modal_position' },
        { id: '#schoolForm', action: 'addSchool', modal: '#modal_school' },
        { id: '#schoolProgramForm', action: 'SchoolProgram', modal: '#modal_school_program' },
        { id: '#majorProgramForm', action: 'MajorProgram', modal: '#modal_major_course' },
        { id: '#boardResolutionForm', action: 'BoardResolution', modal: '#modal_board_resolution' },
        { id: '#academicResolutionForm', action: 'AcademicResolution', modal: '#modal_academic_resolution' },
        { id: '#employmentStatusForm', action: 'UpdateEmploymentStatus', modal: '#modal_status_update'},
        { id: '#accreditationForm', action: 'Accreditation', modal: '#modal_accreditation'},
        { id: '#areaForm', action: 'Area', modal: '#modal_area'},
        { id: '#cityResolutionForm', action: 'CityResolution', modal: '#modal_city_resolution'},
        { id: '#childForm', action: 'Child', modal: '#modal_child'}
    ];

    forms.forEach(form => {
        handleAjaxFormSubmission(
            form.id,
            `../controller/employeeController.php?action=${form.action}`,
            form.modal
        );
    });

    // Combine all modal IDs into a single selector
    const modalSelectors = forms.map(f => f.modal).join(', ');
    $(modalSelectors).on('hidden.bs.modal', function () {
        location.reload(); // Replace with DataTable reload if applicable
    });
});




function handleAjaxFormSubmission(formSelector, actionUrl, modalSelector) {
    $(formSelector).on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData($(this)[0]);

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
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

function openUpdateSchoolProgramModal(schProgid, schid, schProgram, progCode, majorcourse) {
    document.getElementById("schoolProgramForm").reset();
    document.getElementById("school_program_id").value = schProgid;
    document.querySelector("input[name='programDescription']").value = schProgram;
    document.querySelector("input[name='programCode']").value = progCode;
   // document.querySelector("input[name='MajorCourse']").value = majorcourse;
    document.getElementById('schoolProgram').value = schid; // SET category here
    
    const majorInput = document.querySelector("input[name='MajorCourse']");
    const majorCheckbox = document.getElementById("withMajorCheckbox");
    const majorCourseGroup = document.getElementById("majorCourseGroup");

    // Set Major Course value
    majorInput.value = majorcourse;
    

    // Show and check the "With Major" checkbox if majorcourse is not empty and not "N/A"
    if (majorcourse && majorcourse.trim().toUpperCase() !== "N/A") {
        //majorInput.value = majorcourse;
        console.log(  majorInput.value = majorcourse);
        document.getElementById('MajorCourse').value = majorcourse;
        majorCheckbox.checked = true;
        majorCourseGroup.style.display = "block";
    } else {
        majorCheckbox.checked = false;
        majorCourseGroup.style.display = "none";
        majorInput.value = "N/A";
    }
    
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

function openUpdateBoardResolutionModal(boardResolution, boardResolutionCode, boardResolutionYear, boardResolutionID) {
    openModal({
        formId: "boardResolutionForm",
        idField: "board_resolution_id",
        idValue: boardResolutionID,
        fields: {
            "textarea[name='boardResolution']": boardResolution,
            "input[name='resolutionCode']": boardResolutionCode,
            "input[name='resolutionYear']": boardResolutionYear
        },
        titleId: "modal-title-board-resolution",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Board Resolution",
        buttonId: "btn-save-board-resolution",
        buttonText: "Update Board Resolution",
        buttonClass: "btn-primary",
        headerId: "modal-header-board-resolution",
        headerClass: "bg-primary",
        modalId: "modal_board_resolution"
    });
}


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
            "textarea[name='academicResolution']": academicResolution,
            "input[name='academicresolutionCode']": academicResolutionCode,
            "input[name='academicResolutionYear']": academicResolutionYear
        },
        titleId: "modal-title-academic-resolution",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Academic Resolution",
        buttonId: "btn-save-academic-resolution",
        buttonText: "Update Academic Resolution",
        buttonClass: "btn-primary",
        headerId: "modal-header-academic-resolution",
        headerClass: "bg-primary",
        modalId: "modal_academic_resolution"
    });
}

function updateStatusModal(EmploymentStatus, employeeID) {
    console.log("employeeID passed to modal:", employeeID); // For debug
    openModal({
        formId: "employmentStatusForm",
        idField: "employee_status_id",
        idValue: employeeID,
        fields: {
            "select[name='employmentStatus']": EmploymentStatus
        },
        titleId: "modal-title-employmentStatus",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Employment Status",
        buttonId: "btn-save-employment-status",
        buttonText: "Update Employment Status",
        buttonClass: "btn-primary",
        headerId: ".modal-header",
        headerClass: "modal-header bg-info",
        modalId: "modal_status_update"
    });
}

//Accreditation Modal
function openAddAccreditationModal() {
    openModal({
        formId: "accreditationForm",
        idField: "accreditation_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-accreditation",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add Accreditation",
        buttonId: "btn-accreditation",
        buttonText: "Add Accreditation",
        buttonClass: "btn-success",
        headerId: "modal-header-accreditation",
        headerClass: "bg-success",
        modalId: "modal_accreditation"
    });
}


function openUpdateAccreditationModal(accreditation, accreditationCode, accreditationID) {
    openModal({
        formId: "accreditationForm",
        idField: "accreditation_id",
        idValue: accreditationID,
        fields: {            
            "input[name='accreditation']": accreditation,
            "input[name='AccreditationCodeName']": accreditationCode
        },
        titleId: "modal-title-accreditation",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Accreditation",
        buttonId: "btn-accreditation",
        buttonText: "Update Accreditation",
        buttonClass: "btn-primary",
        headerId: "modal-header-accreditation",
        headerClass: "bg-primary",
        modalId: "modal_accreditation"
    });
}

function openAddAreaModal() {
    openModal({
        formId: "areaForm",
        idField: "area_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-area",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add Area",
        buttonId: "btn-accreditation",
        buttonText: "Add Area",
        buttonClass: "btn-success",
        headerId: "modal-header-area",
        headerClass: "bg-success",
        modalId: "modal_area"
    });
}

function openUpdateAreaModal(areaCode, areaDescription, AreaID) {
    openModal({
        formId: "areaForm",
        idField: "area_id",
        idValue: AreaID,
        fields: {            
            "input[name='areaCode']": areaCode,
            "input[name='areaDescription']": areaDescription
        },
        titleId: "modal-title-area",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Area",
        buttonId: "btn-area",
        buttonText: "Update Accreditation",
        buttonClass: "btn-primary",
        headerId: "modal-header-area",
        headerClass: "bg-primary",
        modalId: "modal_area"
    });
}

function openAddCityResolutionModal() {
    openModal({
        formId: "cityResolutionForm",
        idField: "city_resolution_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-city-resolution",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add City Resolution",
        buttonId: "btn-save-city-resolution",
        buttonText: "Add City Resolution",
        buttonClass: "btn-success",
        headerId: "modal-header",
        headerClass: "bg-success",
        modalId: "modal_city_resolution"
    });
}

function openUpdateCityResolutionModal(CityResolution, CityResolutionCode, CityResolutionYear, CityResolutionID) {
    openModal({
        formId: "cityResolutionForm",
        idField: "city_resolution_id",
        idValue: CityResolutionID,
        fields: {
            "textarea[name='cityResolution']": CityResolution,
            "input[name='cityResolutionCode']": CityResolutionCode,
            "input[name='cityResolutionYear']": CityResolutionYear
        },
        titleId: "modal-title-city-resolution",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update City Resolution",
        buttonId: "btn-save-city-resolution",
        buttonText: "Update City Resolution",
        buttonClass: "btn-primary",
        headerId: "modal-header-city-resolution",
        headerClass: "bg-primary",
        modalId: "modal_city_resolution"
    });
}


function openAddChild() {
    openModal({
        formId: "childForm",
        idField: "child_id",
        idValue: "",
        fields: {},
        titleId: "modal-title-child",
        icon: "<i class='ph-plus me-2'></i>",
        title: "Add Child Dependency",
        buttonId: "btn-child",
        buttonText: "Add Child",
        buttonClass: "btn-success",
        headerId: "modal-header-area",
        headerClass: "bg-success",
        modalId: "modal_child"
    });
}

function openUpdateChildModal(childName, childBirthday, childID) {
    openModal({
        formId: "childForm",
        idField: "child_id",
        idValue: childID,
        fields: {            
            "input[name='childName']": childName,
            "input[name='childBirthday']": childBirthday
        },
        titleId: "modal-title-child",
        icon: "<i class='ph-pencil me-2'></i>",
        title: "Update Child Information",
        buttonId: "btn-child",
        buttonText: "Update Child Information",
        buttonClass: "btn-primary",
        headerId: "modal-header-child",
        headerClass: "bg-primary",
        modalId: "modal_child"
    });
}


// // //DELETE RESOLUTION
// function confirmDeleteBoardResolution(resolutionID) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "This action will permanently delete the board resolution.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#6c757d',
//         confirmButtonText: 'Yes, delete it!',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Send AJAX request to delete
//             fetch('../controller/employeeController.php', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//                 body: `action=deleteBoardResolution&board_resolution_id=${resolutionID}`
//             })
//             .then(response => response.json())
//             .then(data => {
//                 Swal.fire({
//                     icon: data.status,
//                     title: data.status === 'success' ? 'Deleted!' : 'Error!',
//                     text: data.message,
//                     timer: 2000,
//                     showConfirmButton: false
//                 });

//                 if (data.status === 'success') {
//                     setTimeout(() => {
//                         location.reload();
//                     }, 2000);
//                 }
//             })
//             .catch(() => {
//                 Swal.fire('Error!', 'An unexpected error occurred.', 'error');
//             });
//         }
//     });
// }


// function confirmDeleteAcademicResolution(academicResolutionID) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "This action will permanently delete the Academic resolution.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#6c757d',
//         confirmButtonText: 'Yes, delete it!',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Send AJAX request to delete
//             fetch('../controller/employeeController.php', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//                 body: `action=deleteAcademicResolution&academic_resolution_id=${academicResolutionID}`
//             })
//             .then(response => response.json())
//             .then(data => {
//                 Swal.fire({
//                     icon: data.status,
//                     title: data.status === 'success' ? 'Deleted!' : 'Error!',
//                     text: data.message,
//                     timer: 2000,
//                     showConfirmButton: false
//                 });

//                 if (data.status === 'success') {
//                     setTimeout(() => {
//                         location.reload();
//                     }, 2000);
//                 }
//             })
//             .catch(() => {
//                 Swal.fire('Error!', 'An unexpected error occurred.', 'error');
//             });
//         }
//     });
// }


// function confirmDeleteCityResolution(CityResolutionID) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "This action will permanently delete the Academic resolution.",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#d33',
//         cancelButtonColor: '#6c757d',
//         confirmButtonText: 'Yes, delete it!',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Send AJAX request to delete
//             fetch('../controller/employeeController.php', {
//                 method: 'POST',
//                 headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//                 body: `action=deleteCityResolution&city_resolution_id=${CityResolutionID}`
//             })
//             .then(response => response.json())
//             .then(data => {
//                 Swal.fire({
//                     icon: data.status,
//                     title: data.status === 'success' ? 'Deleted!' : 'Error!',
//                     text: data.message,
//                     timer: 2000,
//                     showConfirmButton: false
//                 });

//                 if (data.status === 'success') {
//                     setTimeout(() => {
//                         location.reload();
//                     }, 2000);
//                 }
//             })
//             .catch(() => {
//                 Swal.fire('Error!', 'An unexpected error occurred.', 'error');
//             });
//         }
//     });
// }


function confirmDelete(resolutionID, action, resolutionName) {
    Swal.fire({
        title: 'Are you sure?',
        text: `This action will permanently delete the ${resolutionName}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../controller/employeeController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=${action}&id=${resolutionID}`
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: data.status,
                    title: data.status === 'success' ? 'Deleted!' : 'Error!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                if (data.status === 'success') {
                    setTimeout(() => location.reload(), 2000);
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'An unexpected error occurred.', 'error');
            });
        }
    });
}

document.getElementById('userAccountForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        Swal.fire({
            icon: data.status,
            title: data.status === 'success' ? 'Success!' : 'Error!',
            text: data.message
        }).then(() => {
            if (data.status === 'success') {
                let modal = bootstrap.Modal.getInstance(document.getElementById('modal-user-account'));
                modal.hide();
                location.reload();
            }
        });
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong while updating the account.'
        });
    });
});



