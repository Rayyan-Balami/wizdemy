let category = "note";
$(document).ready(function () {
  //extract the page from the url /profile/1 or /search?q=math
  const page = window.location.pathname.split("/")[1];

  // Add event listener to the "requestCheck" checkbox
  $("#requestCheck").on("change", function () {
    if ($(this).is(":checked")) {
      //if the requestCheck is checked, then disable the projectRadio and usersRadio
      $("#projectsCategory").prop("disabled", true);
      $("#userCategory").prop("disabled", true);
      changeCategory(page);
    } else {
      //if the requestCheck is unchecked, then enable the projectRadio
      $("#projectsCategory").prop("disabled", false);
      $("#userCategory").prop("disabled", false);
      changeCategory(page);
    }
  });
});

function changeCategory(page) {
  //enable the requestCheck
  $("#requestCheck").prop("disabled", false);
  category = $("input[name='category']:checked").val(); // Get the currently selected category
  console.log(page, category);
  if (page === "request") {
    requestCategoryChange(page, category);
  } else if (page === "profile") {
    if ($("#requestCheck").prop("checked")) {
      myRequests(page, category);
    } else {
      myMaterials(page, category);
    }
  } else if (page === "search") {
    if ($("#requestCheck").prop("checked")) {
      searchRequests(page, category);
    } else {
      searchMaterials(page, category);
    }
  }
}

// Declare cardCategory globally
const cardCategory = $(".card-category");

function ajaxRequest(url, type, data = {}, cardType, zeroResultType, page) {
  let cardSection = $(".card-section");
  const ZeroResultSection = $(".zeroResult-container");

  if (cardSection.length === 0) {
    cardSection = $("<div class='card-section'></div>");
    cardCategory.after(cardSection);
  } else {
    cardSection.empty();
  }

  ZeroResultSection.remove();

  $.ajax({
    url: url,
    type: type,
    data: data,
    success: function (response) {
      console.log(response);
      renderData(response.data, cardType, zeroResultType, page);
    },
    error: function (error) {
      console.log(error);
      cardSection.html("Failed to load data");
    },
  });
}

function renderData(data, cardType, zeroResultType, page) {
  const cardSection = $(".card-section");

  if (data.length === 0) {
    cardCategory.after(ZeroResult(zeroResultType));
    cardSection.remove();
    return;
  }

  data.forEach((item) => {
    let card;
    if (cardType === "request") {
      card = RequestCard(
        page,
        item.request_id,
        item.user_id,
        item.title,
        item.subject,
        item.description,
        item.education_level,
        item.class_faculty,
        item.semester,
        item.no_of_materials,
        item.document_type,
        item.username,
        item.created_at,
        item.status
      );
    } else if (cardType === "material") {
      card = MaterialCard(
        page,
        item.class_faculty,
        item.comments_count,
        item.created_at,
        item.document_type,
        item.education_level,
        item.file_path,
        item.format,
        item.likes_count,
        item.material_id,
        item.responded_to,
        item.semester,
        item.subject,
        item.thumbnail_path,
        item.title,
        item.user_id,
        item.updated_at,
        item.username,
        item.views_count,
        item.status
      );
    } else if (cardType === "project") {
      card = ProjectCard(
        page,
        item.project_id,
        item.repo_link,
        item.user_id,
        item.username,
        item.created_at,
        item.updated_at,
        item.status
      );
    } else if (cardType === "user") {
      card = UserCard(
        page,
        item.user_id,
        item.username,
        item.full_name,
        item.private,
        item.created_at,
        item.education_level,
        item.user_type,
        item.materials_count,
        item.project_count,
        item.requests_count,
        item.followers_count,
        item.following_count
      );
    }
    console.log(item);
    cardSection.append(card);
    console.log("card rendered");
    updateTimeAgo();
  });
}

// Functions for different types of AJAX calls

function requestCategoryChange(page, category) {
  ajaxRequest(
    `/api/${page}/category`,
    "POST",
    { category },
    "request",
    "myRequest",
    page
  );
}

function myMaterials(page, category) {
  const user_id = getUserIdFromUrl();
  ajaxRequest(
    `/api/${page}/myMaterials`,
    "POST",
    { category, user_id },
    "material",
    "myMaterial",
    page
  );
}

function myRequests(page, category) {
  const user_id = getUserIdFromUrl();
  ajaxRequest(
    `/api/${page}/myRequests`,
    "POST",
    { category, user_id },
    "request",
    "myRequest",
    page
  );
}

function myProjects(page) {
  $("#requestCheck").prop("disabled", true);
  const user_id = getUserIdFromUrl();
  ajaxRequest(
    `/api/${page}/myProjects`,
    "POST",
    { user_id },
    "project",
    "myProject",
    page
  );
}

function searchMaterials(page, category) {
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(
    `/api/search?q=${searchQuery}`,
    "POST",
    {
      category,
      search_type: "material",
    },
    "material",
    "search",
    page
  );
}

function searchRequests(page, category) {
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(
    `/api/search?q=${searchQuery}`,
    "POST",
    {
      category,
      search_type: "request",
    },
    "request",
    "search",
    page
  );
}

function searchProjects(page) {
  $("#requestCheck").prop("disabled", true);
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(
    `/api/search?q=${searchQuery}`,
    "POST",
    {
      search_type: "project",
    },
    "project",
    "search",
    page
  );
}

function searchUsers(page) {
  console.log("searchUsers fun");
  $("#requestCheck").prop("disabled", true);
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(
    `/api/search?q=${searchQuery}`,
    "POST",
    {
      search_type: "user",
    },
    "user",
    "search",
    page
  );
}

// Helper functions

function getUserIdFromUrl() {
  const pathSegments = window.location.pathname.split("/");
  return pathSegments[pathSegments.length - 1];
}

function getSearchQueryFromUrl() {
  return new URLSearchParams(window.location.search).get("q");
}
