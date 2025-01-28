$(document).ready(function () {
  $("#collection_mode").change(function () {
    var collection_mode = $(this).val();
    getBankNames();
    if (collection_mode == "2") {
      //if Checque choosen, clear all othre
      $("#trans_id").val("");
      $("#trans_date").val("");
      $("#cheque_no").val("");

      //if Cheque Chosen
      $(".cheque").show();
      $(".transaction").show();
      $(".other").hide(); //Extra div for alignment
      getChequeNoList(); //to get Cheque Numbers list based on the request id
    } else if (collection_mode >= "3" && collection_mode <= "5") {
      // clear all others
      $("#trans_id").val("");
      $("#trans_date").val("");
      $("#cheque_no").val("");

      //If other than cash and cheque
      $(".cheque").hide();
      $(".transaction").show();
      $(".other").show(); //Extra div for alignment
    } else if (collection_mode == "1") {
      //if Cash choosen, clear all othre
      $("#trans_id").val("");
      $("#trans_date").val("");
      $("#cheque_no").val("");

      $(".cheque").hide();
      $(".transaction").hide();
      $(".other").hide(); //Extra div for alignment
    } else {
      //If nothing chosen
      $(".cheque").hide();
      $(".transaction").hide();
      $(".other").hide(); //Extra div for alignment
    }
  });

  $(
    "#due_amt_track, #princ_amt_track, #int_amt_track, #penalty_track , #coll_charge_track"
  ).blur(function () {
    var due_amt_track =
      $("#due_amt_track").val() != "" ? $("#due_amt_track").val() : 0;
    var penalty_track =
      $("#penalty_track").val() != "" ? $("#penalty_track").val() : 0;
    var coll_charge_track =
      $("#coll_charge_track").val() != "" ? $("#coll_charge_track").val() : 0;
    var princ_amt_track =
      $("#princ_amt_track").val() != "" ? $("#princ_amt_track").val() : 0;
    var int_amt_track =
      $("#int_amt_track").val() != "" ? $("#int_amt_track").val() : 0;

    var total_paid_track =
      parseInt(due_amt_track) +
      parseInt(princ_amt_track) +
      parseInt(int_amt_track) +
      parseInt(penalty_track) +
      parseInt(coll_charge_track);
    $("#total_paid_track").val(total_paid_track);
  });

  $("#pre_close_waiver , #penalty_waiver , #coll_charge_waiver").blur(
    function () {
      var pre_close_waiver =
        $("#pre_close_waiver").val() != "" ? $("#pre_close_waiver").val() : 0;
      var penalty_waiver =
        $("#penalty_waiver").val() != "" ? $("#penalty_waiver").val() : 0;
      var coll_charge_waiver =
        $("#coll_charge_waiver").val() != ""
          ? $("#coll_charge_waiver").val()
          : 0;

      var total_waiver =
        parseInt(pre_close_waiver) +
        parseInt(penalty_waiver) +
        parseInt(coll_charge_waiver);
      $("#total_waiver").val(total_waiver);
    }
  );

  //Collection Charge

  $("#collectionChargeDateCheck").hide();
  $("#purposeCheck").hide();
  $("#amntCheck").hide();
  $("#collChargeBtn").click(function () {
    let req_id = $("#cc_req_id").val();
    let customer_id = $("#cusidupd").val();
    let colluserid = $("#colluserid").val();
    let collectionCharge_date = $("#collectionCharge_date").attr("value"); //coz value inside is not working properly
    let collectionCharge_purpose = $("#collectionCharge_purpose").val();
    let collectionCharge_Amnt = $("#collectionCharge_Amnt").val();
    if (
      collectionCharge_date != "" &&
      collectionCharge_purpose != "" &&
      collectionCharge_Amnt != "" &&
      req_id != ""
    ) {
      $.ajax({
        url: "collectionFile/collection_charges_submit.php",
        type: "POST",
        data: {
          collDate: collectionCharge_date,
          collPurpose: collectionCharge_purpose,
          collAmnt: collectionCharge_Amnt,
          reqId: req_id,
          cust_id: customer_id,
          userId: colluserid,
        },
        cache: false,
        success: function (response) {
          var insresult = response.includes("Inserted");
          // var updresult = response.includes("Updated");
          if (insresult) {
            $("#collChargeInsertOk").show();
            setTimeout(function () {
              $("#collChargeInsertOk").fadeOut("fast");
            }, 2000);
          } else {
            $("#collChargeNotOk").show();
            setTimeout(function () {
              $("#collChargeNotOk").fadeOut("fast");
            }, 2000);
          }
          resetcollCharges(req_id);
        },
      });
      $("#collectionChargeDateCheck").hide();
      $("#purposeCheck").hide();
      $("#amntCheck").hide();
    } else {
      if (collectionCharge_date == "") {
        $("#collectionChargeDateCheck").show();
      } else {
        $("#collectionChargeDateCheck").hide();
      }
      if (collectionCharge_purpose == "") {
        $("#purposeCheck").show();
      } else {
        $("#purposeCheck").hide();
      }
      if (collectionCharge_Amnt == "") {
        $("#amntCheck").show();
      } else {
        $("#amntCheck").hide();
      }
    }
  });

  $("#submit_collection").click(function (event) {
    event.preventDefault();
    let submit_btn = $(this);
    submit_btn.attr("disabled", true);
    if (validations()) {
      let totAmt = $("#total_paid_track").val();
      Swal.fire({
        title: `The Total Paid Amount is  ${totAmt}`,
        text: "Are you sure to Submit?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#009688",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
      }).then(function (result) {
        if (result.isConfirmed) {
          submitCollection();
        } else {
          //if cancelled, re-enable the submit button
          submit_btn.removeAttr("disabled");
        }
      });
    } else {
      //if the validation false, re-enable the submit button
      submit_btn.removeAttr("disabled");
    }
  });

  window.onscroll = function () {
    let navbar = document.getElementById("navbar");
    let navAttr = navbar.getAttribute("class");
    let stickyHeader = navbar.offsetTop;
    if (window.pageYOffset > 200 && navAttr.includes("collection-card")) {
      // navbar.style.display = "block";
      $("#navbar").fadeIn("fast");
      navbar.classList.add("stickyHeader");
    } else {
      $("#navbar").fadeOut("fast");
      navbar.classList.remove("stickyHeader");
    }
  };

  {
    // Get today's date
    var today = new Date().toISOString().split("T")[0];

    // Set the minimum date in the date input to today
    $("#comm_date").attr("min", today);
  }
  $("#comm_ftype").change(function () {
    let type = $(this).val();
    let append;
    if (type == 1) {
      //direct
      append = `<option value="">Select Follow Up Status</option><option value='1'>Commitment</option><option value='2'>Unavailable</option>`;
    } else if (type == 2) {
      //mobile
      append = `<option value="">Select Follow Up Status</option><option value='1'>Commitment</option><option value='3'>RNR</option><option value='4'>Not Reachable</option>
            <option value='5'>Switch Off</option><option value='6'>Not in Use</option><option value='7'>Blocked</option>`;
    } else {
      append = `<option value="">Select Follow Up Status</option>`;
    }
    $("#comm_fstatus").empty().append(append);
  });

  $("#comm_fstatus").change(function () {
    let status = $(this).val();
    if (status == 1) {
      //commitment
      $(".person-div").show();
    } else {
      $(".person-div").hide();
      $(
        "#comm_person_type,#comm_person_name,#comm_person_name1,#comm_relationship"
      ).val(""); //empty values when hiding person div
    }
  });

  $("#comm_person_type").change(function () {
    let type = $(this).val();
    let req_id = $("#comm_req_id").val();
    let cus_id = $("#cusidupd").val();
    if (type == 1) {
      let cus_name = $("#cus_name").val();
      $("#comm_person_name1").hide(); //select box
      $("#comm_person_name").show();
      $("#comm_person_name").val(cus_name); //storing customer name in person name
      $("#comm_relationship").val("NIL");
    } else if (type == 2) {
      type = 1; //cause in below url garentor is managed as type 1
      $.post(
        "verificationFile/documentation/check_holder_name.php",
        { reqId: req_id, type },
        function (response) {
          //if guarentor show readonly input box and hide select box
          $("#comm_person_name").show();
          $("#comm_person_name1").hide(); //select box
          $("#comm_person_name1").empty(); //select box

          $("#comm_person_name").val(response["name"]);
          $("#comm_relationship").val(response["relationship"]);
        },
        "json"
      );
    } else if (type == 3) {
      $.post(
        "verificationFile/verificationFam.php",
        { cus_id },
        function (response) {
          //if Family member then show dropdown and hide input box
          $("#comm_person_name1").show(); //select box
          $("#comm_person_name").hide();
          $("#comm_person_name").empty();

          $("#comm_person_name1")
            .empty()
            .append("<option value=''>Select Person Name</option>");
          for (var i = 0; i < response.length - 1; i++) {
            $("#comm_person_name1").append(
              "<option value='" +
                response[i]["fam_id"] +
                "'>" +
                response[i]["fam_name"] +
                "</option>"
            );
          }

          //create onchange event for person name that will bring the relationship of selected customer
          $("#comm_person_name1")
            .off("change")
            .change(function () {
              let person = $(this).val();
              for (var i = 0; i < response.length - 1; i++) {
                if (person == response[i]["fam_id"]) {
                  $("#comm_relationship").val(response[i]["relationship"]);
                }
              }
            });
        },
        "json"
      );
    }
  });

  $("#sumit_add_comm").click(function () {
    if (validateCommitment() == true) {
      submitCommitment();
    }
  });

  $("#addCommitment")
    .find(".closeModal")
    .click(function () {
      $("#addCommitment")
        .find(".modal-body input,select")
        .not("#comm_fdate,#comm_user_type,#comm_user")
        .val("");
      $("#addCommitment").find(".modal-body span").hide();
      $(".person-div").hide();
    });
}); //Document Ready End

//On Load Event
$(function () {
  $(".collection_card").hide(); //Hide collection window at the starting
  $("#close_collection_card").hide(); //Hide collection close button at the starting
  $("#submit_collection").hide(); //Hide Submit button at the starting, because submit is only for collection

  var req_id = $("#idupd").val();
  const cus_id = $("#cusidupd").val();
  OnLoadFunctions(req_id, cus_id);

  var cus_pic = $("#cuspicupd").val();
  $("#imgshow").attr("src", "uploads/request/customer/" + cus_pic);
});

function OnLoadFunctions(req_id, cus_id) {
  //To get loan sub Status
  var pending_arr = [];
  var od_arr = [];
  var due_nil_arr = [];
  var closed_arr = [];
  var balAmnt = [];
  $.ajax({
    url: "collectionFile/resetCustomerStatus.php",
    data: { cus_id: cus_id },
    dataType: "json",
    type: "post",
    cache: false,
    success: function (response) {
      if (response.length != 0) {
        for (var i = 0; i < response["pending_customer"].length; i++) {
          pending_arr[i] = response["pending_customer"][i];
          od_arr[i] = response["od_customer"][i];
          due_nil_arr[i] = response["due_nil_customer"][i];
          closed_arr[i] = response["closed_customer"][i];
          balAmnt[i] = response["balAmnt"][i];
        }
        var pending_sts = pending_arr.join(",");
        $("#pending_sts").val(pending_sts);
        var od_sts = od_arr.join(",");
        $("#od_sts").val(od_sts);
        var due_nil_sts = due_nil_arr.join(",");
        $("#due_nil_sts").val(due_nil_sts);
        var closed_sts = closed_arr.join(",");
        $("#closed_sts").val(closed_sts);
        balAmnt = balAmnt.join(",");
        // $('#balAmnt').val(balAmnt);
      }
    },
  }).then(() => {
    showOverlay(); //loader start
    var pending_sts = $("#pending_sts").val();
    var od_sts = $("#od_sts").val();
    var due_nil_sts = $("#due_nil_sts").val();
    var closed_sts = $("#closed_sts").val();
    var bal_amt = balAmnt;
    $.ajax({
      //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
      url: "collectionFile/getLoanList.php",
      data: {
        req_id: req_id,
        cus_id: cus_id,
        pending_sts: pending_sts,
        od_sts: od_sts,
        due_nil_sts: due_nil_sts,
        closed_sts: closed_sts,
        bal_amt: bal_amt,
      },
      type: "post",
      cache: false,
      success: function (response) {
        $(".overlay").remove();
        $("#loanListTableDiv").empty();
        $("#loanListTableDiv").html(response);

        $(".collection-window").click(function () {
          $(".personalinfo_card").hide();
          $(".loanlist_card").hide();
          $(".back-button").hide();
          $(".collection_card").show();
          let navbar = document.getElementById("navbar");
          navbar.classList.add("collection-card");
          $("#close_collection_card").show();
          $("#submit_collection").show();

          var req_id = $(this).attr("data-value");

          //To get the loan category ID to store when collection form submitted
          $.ajax({
            url: "collectionFile/getDetailForCollection.php",
            data: { req_id: req_id },
            dataType: "json",
            type: "post",
            cache: false,
            success: function (response) {
              var loan_category_id = response["loan_category"];
              var sub_category_id = response["sub_category"];
              $("#loan_category_id").val(loan_category_id);
              $("#sub_category_id").val(sub_category_id);
            },
          });
          var loan_category = $(this)
            .parent()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .text();
          var sub_category = $(this)
            .parent()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .prev()
            .text();
          var status = $(this).parent().prev().prev().text();
          var sub_status = $(this).parent().prev().text();

          $("#req_id").val(req_id);
          $("#loan_category").val(loan_category);
          $("#sub_category").val(sub_category);
          $("#status").val(status);
          $("#sub_status").val(sub_status);

          //To get Collection Code
          $.ajax({
            url: "collectionFile/getCollectionCode.php",
            data: {},
            dataType: "json",
            type: "post",
            cache: false,
            success: function (response) {
              $("#collection_id").val(response);
            },
          });

          //To get Cheque List
          $.ajax({
            url: "collectionFile/getChequeList.php",
            data: { req_id: req_id },
            dataType: "json",
            type: "post",
            cache: false,
            success: function (response) {
              $("#cheque_no").empty();
              $("#cheque_no").append(
                '<option value="">Select Cheque No</option>'
              );
              for (var i = 0; i < response.length; i++) {
                $("#cheque_no").append(
                  '<option value="' +
                    response[i]["cheque_no_id"] +
                    '">' +
                    response[i]["cheque_no"] +
                    "</option>"
                );
              }
              $("#cheque_no").change(function () {
                var cheque_no = $(this).val();
                if (cheque_no != "") {
                  for (var i = 0; i < response.length; i++) {
                    if (cheque_no == response[i]["cheque_no_id"]) {
                      var holder_name = response[i]["cheque_holder_name"];
                    }
                  }
                  $(".chequeSpan").text("* " + holder_name);
                } else {
                  $(".chequeSpan").text("*");
                }
              });
            },
          });

          //in this file, details gonna fetch by request ID, Not by customer ID (Because we need loan details from particular request ID)
          $.ajax({
            url: "collectionFile/getLoanDetails.php",
            data: { req_id: req_id, cus_id: cus_id },
            dataType: "json",
            type: "post",
            cache: false,
            success: function (response) {
              //Display all value to readonly fields
              $("#tot_amt").val(response["total_amt"]);
              $("#paid_amt").val(response["total_paid"]);
              $("#bal_amt").val(response["balance"]);
              $("#due_amt").val(response["due_amt"]);
              $("#pending_amt").val(response["pending"]);
              $("#pend_amt").val(response["pending"]);
              $("#payable_amt").val(response["payable"]);
              $("#payableAmount").val(response["payable"]);
              $("#penalty").val(response["penalty"]);
              $("#coll_charge").val(response["coll_charge"]);

              if (response["loan_type"] == "interest") {
                $(".till-date-int").show();
                $("#till_date_int").val(response["till_date_int"].toFixed(0));
                $("#tot_amt").prev().prev().text("Principal Amount");
                $("#due_amt").prev().prev().text("Interest Amount");

                $(".emiLoanDiv").hide();
                $(".intLoanDiv").show();

                //Show all in span class
                $(".totspan").text("*");
                $(".paidspan").text("*");
                $(".balspan").text("*");
                $(".pendingspan").text("*");
                $(".payablespan").text("*");
              } else {
                $(".till-date-int").hide();
                $("#till_date_int").val("");
                $("#tot_amt").prev().prev().text("Total Amount");
                $("#due_amt").prev().prev().text("Due Amount");

                $(".emiLoanDiv").show();
                $(".intLoanDiv").hide();

                //to get how many due are pending till now
                var totspan = (
                  response["total_amt"] / response["due_amt"]
                ).toFixed(1);
                var paidspan = (
                  response["total_paid"] / response["due_amt"]
                ).toFixed(1);
                var balspan = (
                  response["balance"] / response["due_amt"]
                ).toFixed(1);
                var pendingspan = (
                  response["pending"] / response["due_amt"]
                ).toFixed(1);
                var payablespan = (
                  response["payable"] / response["due_amt"]
                ).toFixed(1);

                //Show all in span class
                $(".totspan").text("* (No of Due : " + totspan + ")");
                $(".paidspan").text("* (No of Due : " + paidspan + ")");
                $(".balspan").text("* (No of Due : " + balspan + ")");
                $(".pendingspan").text("* (No of Due : " + pendingspan + ")");
                $(".payablespan").text("* (No of Due : " + payablespan + ")");
              }

              //To set limitations for input fields
              $("#due_amt_track").on("blur", function () {
                if (parseInt($(this).val()) > response["balance"]) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_paid_track").val("");
                }
                $("#pre_close_waiver").trigger("blur"); //this will check whether preclosure amount crosses limit
              });

              $("#princ_amt_track").on("blur", function () {
                if (parseInt($(this).val()) > response["balance"]) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_paid_track").val("");
                }
                $("#pre_close_waiver").trigger("blur"); //this will check whether preclosure amount crosses limit
              });

              $("#int_amt_track").on("blur", function () {
                if (parseInt($(this).val()) > response["payable"]) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_paid_track").val("");
                }
              });

              $("#penalty_track").on("blur", function () {
                if (parseInt($(this).val()) > response["penalty"]) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_paid_track").val("");
                }
              });

              $("#coll_charge_track").on("blur", function () {
                if (parseInt($(this).val()) > response["coll_charge"]) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_paid_track").val("");
                }
              });

              //To set Limitation that should not cross its limit with considering track values and previous readonly values
              $("#pre_close_waiver").on("blur", function () {
                if (response["loan_type"] == "emi") {
                  var due_track = $("#due_amt_track").val();
                  if (
                    parseFloat($(this).val()) >
                    response["balance"] - due_track
                  ) {
                    alert("Enter a Lesser Value");
                    $(this).val("");
                    $("#total_waiver").val("");
                  }
                } else if (response["loan_type"] == "interest") {
                  var princ_track = $("#princ_amt_track").val();
                  if (
                    parseFloat($(this).val()) >
                    response["balance"] - princ_track
                  ) {
                    alert("Enter a Lesser Value");
                    $(this).val("");
                    $("#total_waiver").val("");
                  }
                }
              });

              $("#penalty_waiver").on("blur", function () {
                var penalty_track = $("#penalty_track").val();
                if (
                  parseFloat($(this).val()) >
                  response["penalty"] - penalty_track
                ) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_waiver").val("");
                }
              });

              $("#coll_charge_waiver").on("blur", function () {
                var coll_charge_track = $("#coll_charge_track").val();
                if (
                  parseFloat($(this).val()) >
                  response["coll_charge"] - coll_charge_track
                ) {
                  alert("Enter a Lesser Value");
                  $(this).val("");
                  $("#total_waiver").val("");
                }
              });
            },
          });
        });
        $("#close_collection_card").click(function () {
          $(".personalinfo_card").show();
          $(".loanlist_card").show();
          $(".back-button").show();
          $(".collection_card").hide();
          $("#close_collection_card").hide();
          $("#submit_collection").hide();
        });
        $(".due-chart").click(function () {
          var req_id = $(this).attr("value");
          dueChartList(req_id, cus_id, function () {
            $(document).off("click", ".print_due_coll");
            $(document).on("click", ".print_due_coll", function () {
              var id = $(this).attr("value");
              Swal.fire({
                title: "Print",
                text: "Do you want to print this collection?",
                // icon: 'question',
                // showConfirmButton: true,
                // confirmButtonColor: '#009688',
                imageUrl: "img/printer.png",
                imageWidth: 300,
                imageHeight: 210,
                imageAlt: "Custom image",
                showCancelButton: true,
                confirmButtonColor: "#009688",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                confirmButtonText: "Yes",
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: "collectionFile/print_collection.php",
                    data: { coll_id: id },
                    type: "post",
                    cache: false,
                    success: function (html) {
                      $("#printcollection").html(html);
                      // Get the content of the div element
                      var content = $("#printcollection").html();

                      // Create a new window
                      // var w = window.open();

                      // Write the content to the new window
                      // $(document.body).html(content);

                      // Print the new window
                      // w.print();

                      // Close the new window
                      // w.close();
                    },
                  });
                }
              });
            });
          }); // To show Due Chart List.
        });
        $(".penalty-chart").click(function () {
          var req_id = $(this).attr("value");
          $.ajax({
            //to insert penalty by on click
            url: "collectionFile/getLoanDetails.php",
            data: { req_id: req_id, cus_id: cus_id },
            dataType: "json",
            type: "post",
            cache: false,
            success: function (response) {
              penaltyChartList(req_id, cus_id); //To show Penalty List.
            },
          });
        });
        $(".coll-charge-chart").click(function () {
          var req_id = $(this).attr("value");
          collectionChargeChartList(req_id); //To Show Fine Chart List
        });
        $(".coll-charge").click(function () {
          var req_id = $(this).attr("value");
          resetcollCharges(req_id); //Fine
        });
        $(".add-commitment-chart").click(function () {
          let req_id = $(this).data("reqid");
          $("#comm_req_id").val(req_id);
        });
        $(".commitment-chart")
          .off("click")
          .click(function () {
            //Commitment chart
            let req_id = $(this).data("reqid");
            let cus_id = $("#cusidupd").val();
            $.post(
              "followupFiles/dueFollowup/getCommitmentChart.php",
              { cus_id, req_id },
              function (html) {
                $("#commChartDiv").empty().html(html);
              }
            );
          });
        $(".move-error").click(function () {
          if (confirm("Are you Sure To move this Loan to Error?")) {
            let getidupd = $("#idupd").val();
            let getcusidupd = $("#cusidupd").val();
            var req_id = $(this).attr("value");
            var cus_status = "15";
            $.ajax({
              url: "collectionFile/moveStatus.php",
              data: { req_id: req_id, cus_status: cus_status },
              dataType: "json",
              type: "post",
              cache: false,
              success: function (response) {
                if (response.includes("Success")) {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Moved To Error!",
                    icon: "success",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                  setTimeout(function () {
                    window.location =
                      "collection&upd=" + getidupd + "&cusidupd=" + getcusidupd;
                  }, 2000);
                } else {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Error While Moving!",
                    icon: "error",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                }
              },
            });
          } else {
            event.preventDefault();
          }
        });
        $(".move-legal").click(function () {
          if (confirm("Are you Sure To move this Loan to Legal?")) {
            let getidupd = $("#idupd").val();
            let getcusidupd = $("#cusidupd").val();
            var req_id = $(this).attr("value");
            var cus_status = "16";
            $.ajax({
              url: "collectionFile/moveStatus.php",
              data: { req_id: req_id, cus_status: cus_status },
              dataType: "json",
              type: "post",
              cache: false,
              success: function (response) {
                if (response.includes("Success")) {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Moved To Legal!",
                    icon: "success",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                  setTimeout(function () {
                    window.location =
                      "collection&upd=" + getidupd + "&cusidupd=" + getcusidupd;
                  }, 2000);
                } else {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Error While Moving!",
                    icon: "error",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                }
              },
            });
          } else {
            event.preventDefault();
          }
        });
        $(".return-sub").click(function () {
          if (confirm("Are you Sure To move this Loan to Sub Status?")) {
            let getidupd = $("#idupd").val();
            let getcusidupd = $("#cusidupd").val();
            var req_id = $(this).attr("value");
            var cus_status = "14";
            $.ajax({
              url: "collectionFile/moveStatus.php",
              data: { req_id: req_id, cus_status: cus_status },
              dataType: "json",
              type: "post",
              cache: false,
              success: function (response) {
                if (response.includes("Success")) {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Moved To Sub Status!",
                    icon: "success",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                  setTimeout(function () {
                    window.location =
                      "collection&upd=" + getidupd + "&cusidupd=" + getcusidupd;
                  }, 2000);
                } else {
                  Swal.fire({
                    timerProgressBar: true,
                    timer: 2000,
                    title: "Error While Moving!",
                    icon: "error",
                    showConfirmButton: false,
                    // confirmButtonColor: '#009688'
                  });
                }
              },
            });
          } else {
            event.preventDefault();
          }
        });
        $(".move-closed").click(function () {
          if (confirm("Are you Sure To move this Loan to Closed?")) {
            let getidupd = $("#idupd").val();
            let getcusidupd = $("#cusidupd").val();
            var req_id = $(this).attr("value");
            var cus_status = "20";
            $.ajax({
              url: "collectionFile/moveStatus.php",
              data: { req_id: req_id, cus_status: cus_status },
              dataType: "json",
              type: "post",
              cache: false,
              success: function (response) {
                Swal.fire({
                  timerProgressBar: true,
                  timer: 2000,
                  title: "Moved To Closed!",
                  icon: "succes",
                  showConfirmButton: false,
                  // confirmButtonColor: '#009688'
                });
                setTimeout(function () {
                  window.location =
                    "collection&upd=" + getidupd + "&cusidupd=" + getcusidupd;
                }, 2000);
              },
            });
          } else {
            event.preventDefault();
          }
        });
      },
    });
    hideOverlay(); //loader stop
  }, 2000);
} //Auto Load function END

//to get Cheque Numbers list based on the request id
function getChequeNoList() {}

function getBankNames() {

  
    $.ajax({
        url: 'manageUser/getBankDetails.php',
        data: {},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#bank_id').empty();
            $('#bank_id').append('<option value="">Select Bank Name</option>');
            $.each(response, function (ind, val) {
                $('#bank_id').append('<option value="' + val['id'] + '">' + val['bank_name'] + '</option>');
            })

        }
    })

}

function validations() {
  let collection_mode = $("#collection_mode").val();
  let bank_id = $("#bank_id").val();
  let cheque_no = $("#cheque_no").val();
  let trans_id = $("#trans_id").val();
  let trans_date = $("#trans_date").val();
  let collection_loc = $("#collection_loc").val();
  let total_paid_track = $("#total_paid_track").val();
  let total_waiver = $("#total_waiver").val();
  let retVal = true;

  if (!collection_mode) {
    $("#collectionmodeCheck").show();
    retVal = false;
  } else {
    $("#collectionmodeCheck").hide();

    if (collection_mode == "2") {
      //if Cheque Chosen
      if (bank_id == "") {
        $("#bank_idCheck").show();
        retVal = false;
      } else {
        $("#bank_idCheck").hide();
      }
      if (cheque_no == "") {
        $("#chequeCheck").show();
        retVal = false;
      } else {
        $("#chequeCheck").hide();
      }

      if (trans_id == "") {
        $("#transidCheck").show();
        retVal = false;
      } else {
        $("#transidCheck").hide();
      }
      if (trans_date == "") {
        $("#transdateCheck").show();
        retVal = false;
      } else {
        $("#transdateCheck").hide();
      }
    } else if (collection_mode >= "3" && collection_mode <= "5") {
      //If other than cash and cheque
      if (bank_id == "") {
        $("#bank_idCheck").show();
        retVal = false;
      } else {
        $("#bank_idCheck").hide();
      }
      if (trans_id == "") {
        $("#transidCheck").show();
        retVal = false;
      } else {
        $("#transidCheck").hide();
      }
      if (trans_date == "") {
        $("#transdateCheck").show();
        retVal = false;
      } else {
        $("#transdateCheck").hide();
      }
    }
  }

  if (!collection_loc) {
    $("#collectionlocCheck").show();
    retVal = false;
  } else {
    $("#collectionlocCheck").hide();
  }

  // if(collection_access == 0){

  // }
  if (
    total_paid_track == "" ||
    total_paid_track == 0 ||
    total_paid_track == undefined
  ) {
    if (total_waiver == "" || total_waiver == 0 || total_waiver == undefined) {
      $(".totalpaidCheck").show();
      retVal = false;
    } else {
      $(".totalpaidCheck").hide();
    }
  } else {
    $(".totalpaidCheck").hide();
  }

  // submit_btn.removeAttr('disabled');
  return retVal;
}
function submitCollection() {
  $.post(
    "collectionFile/submitCollection.php",
    $("#collectionForm").serialize(),
    function (response) {
      if (response["info"].includes("Success")) {
        swarlSuccessAlert(response.info);
        setTimeout(function () {
          printCollection(response.coll_id);
        }, 2000);
      } else {
        swarlErrorAlert("Error on Submit");
        $("#submit_collection").removeAttr("disabled");
      }
    },
    "json"
  );
}
function printCollection(coll_id) {
  Swal.fire({
    title: "Print",
    text: "Do you want to print this collection?",
    imageUrl: "img/printer.png",
    imageWidth: 300,
    imageHeight: 210,
    imageAlt: "Custom image",
    showCancelButton: true,
    confirmButtonColor: "#009688",
    cancelButtonColor: "#d33",
    cancelButtonText: "No",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "collectionFile/print_collection.php",
        data: { coll_id: coll_id },
        type: "post",
        cache: false,
        success: function (html) {
          $("#printcollection").html(html);
          // Get the content of the div element
          var content = $("#printcollection").html();
          setTimeout(() => {
            location.reload();
          }, 1500);
        },
      });
    } else {
      location.reload();
    }
  });
}
function submitCommitment() {
  let req_id = $("#comm_req_id").val();
  let cus_id = $("#cusidupd").val();
  let ftype = $("#comm_ftype").val();
  let fstatus = $("#comm_fstatus").val();
  let person_type = $("#comm_person_type").val();
  let person_name = $("#comm_person_name").val();
  let person_name1 = $("#comm_person_name1").val();
  let relationship = $("#comm_relationship").val();
  let remark = $("#comm_remark").val();
  let date = $("#comm_date").val();
  let hint = $("#comm_hint").val();
  let args = {
    cus_id,
    req_id,
    ftype,
    fstatus,
    person_type,
    person_name,
    person_name1,
    relationship,
    remark,
    date,
    hint,
  };

  $.post(
    "followupFiles/dueFollowup/submitCommitment.php",
    args,
    function (response) {
      if (response.includes("Error")) {
        swarlErrorAlert(response);
      } else {
        swarlSuccessAlert(response, function () {
          $(".closeModal").trigger("click");
        });
        $("#addCommitment")
          .find(".modal-body input,select")
          .not("#comm_fdate,#comm_user_type,#comm_user")
          .val("");
        $(".person-div").hide();
      }
    }
  );
}
function validateCommitment() {
  let response = true;
  let ftype = $("#comm_ftype").val();
  let fstatus = $("#comm_fstatus").val();
  let person_type = $("#comm_person_type").val();
  let person_name = $("#comm_person_name").val();
  let person_name1 = $("#comm_person_name1").val();
  let remark = $("#comm_remark").val();
  let comm_date = $("#comm_date").val();
  let hint = $("#comm_hint").val();

  validateField(ftype, "#comm_ftypeCheck");
  validateField(fstatus, "#comm_fstatusCheck");
  if (fstatus == 1) {
    validateField(person_type, "#comm_person_typeCheck");
    if (person_type == 3) {
      validateField(person_name1, "#comm_person_nameCheck");
    } else {
      $("#comm_person_nameCheck").hide();
    }
    validateField(comm_date, "#comm_dateCheck");
  }
  validateField(remark, "#comm_remarkCheck");
  validateField(hint, "#comm_hintCheck");

  function validateField(value, fieldId) {
    if (value === "") {
      response = false;
      event.preventDefault();
      $(fieldId).show();
    } else {
      $(fieldId).hide();
    }
  }

  return response;
}

//Due Chart List
function dueChartList(req_id, cus_id, callback) {

    // var req_id = $('#idupd').val()
    // const cus_id = $('#cusidupd').val()
    $('#dueChartTableDiv').empty();
    $.ajax({
        url: 'collectionFile/getDueChartList.php',
        data: { 'req_id': req_id, 'cus_id': cus_id },
        type: 'post',
        cache: false,
        success: function (response) {
            $('#dueChartTableDiv').html(response)
        }
    }).then(function () {

        $.post('collectionFile/getDueMethodName.php', { req_id }, function (response) {
            $('#dueChartTitle').text('Due Chart ( ' + response['due_method'] + ' - ' + response['loan_type'] + ' )');
        }, 'json');

        callback();
    })

}
//Penalty Chart List
function penaltyChartList(req_id, cus_id) {
  $.ajax({
    url: "collectionFile/getPenaltyChartList.php",
    data: { req_id: req_id, cus_id: cus_id },
    type: "post",
    cache: false,
    success: function (response) {
      $("#penaltyChartTableDiv").empty();
      $("#penaltyChartTableDiv").html(response);
    },
  }); //Ajax End.
}
//Collection Charge Chart List
function collectionChargeChartList(req_id) {
  $.ajax({
    url: "collectionFile/getCollectionChargeList.php",
    data: { req_id: req_id },
    type: "post",
    cache: false,
    success: function (response) {
      $("#collectionChargeDiv").empty();
      $("#collectionChargeDiv").html(response);
    },
  }); //Ajax End.
}
//Fine
function resetcollCharges(req_id) {
  $.ajax({
    url: "collectionFile/collection_charges_reset.php",
    type: "POST",
    data: { reqId: req_id },
    cache: false,
    success: function (html) {
      $("#collChargeTableDiv").empty();
      $("#collChargeTableDiv").html(html);
      $("#cc_req_id").val(req_id);
      $("#collectionCharge_date").val("");
      $("#collectionCharge_purpose").val("");
      $("#collectionCharge_Amnt").val("");
    },
  });
}

// Improved code snippet
function swarlErrorAlert(response) {
  Swal.fire({
    title: response,
    icon: "error",
    confirmButtonText: "Ok",
    confirmButtonColor: "#009688",
  });
}
function swarlInfoAlert(title, text) {
  Swal.fire({
    title: title,
    text: text,
    icon: "info",
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonColor: "#009688",
    cancelButtonColor: "#cc4444",
    cancelButtonText: "No",
    confirmButtonText: "Yes",
  }).then(function (result) {
    if (result.isConfirmed) {
      update();
    }
  });
}
function swarlSuccessAlert(response, callback) {
  Swal.fire({
    title: response,
    icon: "success",
    confirmButtonText: "Ok",
    confirmButtonColor: "#009688",
    timerProgressBar: true,
    timer: 2000,
    showConfirmButton: false,
    willClose: () => {
      // This will run after the timer completes
      if (typeof callback === "function") {
        callback();
      }
    },
  });
}
