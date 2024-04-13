// // Create a new <script> element
// var chartJsCDN = "<script src='https://cdn.jsdelivr.net/npm/chart.js' defer ></script>";
// //append chartJsCDN to the head of the document
// document.head.insertAdjacentHTML("beforeend", chartJsCDN);


const postCategory = document.getElementById("total-post-category-doughnut");
const totalMaterial = postCategory.getAttribute("data-total-material");
const totalRequest = postCategory.getAttribute("data-total-request");
const totalProject = postCategory.getAttribute("data-total-project");
const respondedMaterial = postCategory.getAttribute("data-responded-material");

var postCategoryChart = new Chart(postCategory, {
  type: "doughnut",
  data: {
    labels: ["Material", "Request", "Project"],
    datasets: [
      {
        label: "Total Post Category",
        data: [totalMaterial, totalRequest, totalProject],
        backgroundColor: [
          "rgba(255, 99, 132, 0.8)",
          "rgba(54, 162, 235, 0.8)",
          "rgba(255, 206, 86, 0.8)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
        ],
        borderWidth: 2,
        hoverOffset: 4,
      },
      {
        label: "Responded Material",
        data: [respondedMaterial], // Only the Material category has responded data
        backgroundColor: ["rgba(255, 99, 132, 0.6)"],
        borderColor: ["rgba(255, 99, 132, 1)"],
        borderWidth: 2,
        hoverOffset: 4,
        borderDash: [5, 5],
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      title: {
        display: true,
        text: "Total Post Category",
        position: "bottom",
      },
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 12,
          padding: 20,
        },
      },
    },
  },
});

// bar chart for suspend vs active status
const suspendActiveCategory = document.getElementById(
  "suspend-active-category-bar"
);
const totalMaterialSuspend = suspendActiveCategory.getAttribute(
  "data-total-material-suspend"
);
const totalRequestSuspend = suspendActiveCategory.getAttribute(
  "data-total-request-suspend"
);
const totalProjectSuspend = suspendActiveCategory.getAttribute(
  "data-total-project-suspend"
);
const totalUserSuspend = suspendActiveCategory.getAttribute(
  "data-total-user-suspend"
);
const totalMaterialActive = suspendActiveCategory.getAttribute(
  "data-total-material-active"
);
const totalRequestActive = suspendActiveCategory.getAttribute(
  "data-total-request-active"
);
const totalProjectActive = suspendActiveCategory.getAttribute(
  "data-total-project-active"
);
const totalUserActive = suspendActiveCategory.getAttribute(
  "data-total-user-active"
);

var suspendActiveCategoryChart = new Chart(suspendActiveCategory, {
  type: "bar",
  data: {
    labels: ["Material", "Request", "Project", "User"],
    datasets: [
      {
        label: "Suspend",
        data: [
          totalMaterialSuspend,
          totalRequestSuspend,
          totalProjectSuspend,
          totalUserSuspend,
        ],
        backgroundColor: "rgba(255, 99, 132, 0.8)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1,
        borderRadius: Number.MAX_VALUE,
        borderSkipped: false,
      },
      {
        label: "Active",
        data: [
          totalMaterialActive,
          totalRequestActive,
          totalProjectActive,
          totalUserActive,
        ],
        backgroundColor: "rgba(54, 162, 235, 0.9)",
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
    plugins: {
      title: {
        display: true,
        text: "Suspend vs Active Status",
        position: "bottom",
      },
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 12,
          padding: 20,
        },
      },
    },
  },
});

//line chart for total category in post
const totalCategoryInPost = document.getElementById("total-category-in-post-line");
const totalMaterialNote = totalCategoryInPost.getAttribute("data-total-material-note");
const totalMaterialQuestion = totalCategoryInPost.getAttribute("data-total-material-question");
const totalMaterialLabreport = totalCategoryInPost.getAttribute("data-total-material-labreport");
const totalRequestNote = totalCategoryInPost.getAttribute("data-total-request-note");
const totalRequestQuestion = totalCategoryInPost.getAttribute("data-total-request-qustion");
const totalRequestLabreport = totalCategoryInPost.getAttribute("data-total-request-labreport");

var totalCategoryInPostChart = new Chart(totalCategoryInPost, {
  type: "line",
  data: {
    labels: ["Note", "Question", "Lab Report"],
    datasets: [
      {
        label: "Material",
        data: [totalMaterialNote, totalMaterialQuestion, totalMaterialLabreport],
        backgroundColor: "rgba(255, 99, 132, 0.8)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1,
        borderRadius: Number.MAX_VALUE,
        borderSkipped: false,
      },
      {
        label: "Request",
        data: [totalRequestNote, totalRequestQuestion, totalRequestLabreport],
        backgroundColor: "rgba(54, 162, 235, 0.9)",
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
    plugins: {
      title: {
        display: true,
        text: "Total Category in Post",
        position: "bottom",
      },
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 12,
          padding: 20,
        },
      },
    },
  },
});

// <!-- users and reports means no of users and reports in DB  -->
// 		<div class="chart-div user-category-div">
// 			<canvas id="total-user-and-report-category-stack" 
// 			data-user-student = "<?= $userCounts['student'] ?>"
// 			data-user-teacher = "<?= $userCounts['teacher'] ?>"
// 			data-user-institution = "<?= $userCounts['institution'] ?>"
// 			data-report-pending = "<?= $reportsCounts['pending'] ?>"
// 			data-report-resolved = "<?= $reportsCounts['resolved'] ?>"
// 			></canvas>
// 		</div>

const userAndReportCategory = document.getElementById("total-user-and-report-category-stack");
const userStudent = userAndReportCategory.getAttribute("data-user-student");
const userTeacher = userAndReportCategory.getAttribute("data-user-teacher");
const userInstitution = userAndReportCategory.getAttribute("data-user-institution");
const reportPending = userAndReportCategory.getAttribute("data-report-pending");
const reportResolved = userAndReportCategory.getAttribute("data-report-resolved");

var userAndReportCategoryChart = new Chart(userAndReportCategory, {
  type: "bar",
  data: {
    labels: ["User", "Report"],
    datasets: [
      {
        label: "Student",
        data: [userStudent, 0], // User stack only
        backgroundColor: "rgba(255, 99, 132, 0.8)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1,
        borderRadius: Number.MAX_VALUE,
        borderSkipped: false,
      },
      {
        label: "Teacher",
        data: [userTeacher, 0], // User stack only
        backgroundColor: "rgba(54, 162, 235, 0.8)",
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
      {
        label: "Institution",
        data: [userInstitution, 0], // User stack only
        backgroundColor: "rgba(255, 206, 86, 0.8)",
        borderColor: "rgba(255, 206, 86, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
      {
        label: "Pending",
        data: [0, reportPending], // Report stack only
        backgroundColor: "rgba(75, 192, 192, 0.8)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
      {
        label: "Resolved",
        data: [0, reportResolved], // Report stack only
        backgroundColor: "rgba(153, 102, 255, 0.8)",
        borderColor: "rgba(153, 102, 255, 1)",
        borderWidth: 1,
        borderRadius: 5,
        borderSkipped: false,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        stacked: true,
      },
      y: {
        beginAtZero: true,
        stacked: true,
      },
    },
    plugins: {
      title: {
        display: true,
        text: "Total User and Report Category",
        position: "bottom",
      },
      legend: {
        display: true,
        position: "bottom",
        labels: {
          boxWidth: 12,
          padding: 20,
        },
      },
    },
  },
});