let pageNumber = 1;
let currentPage = window.location.pathname.split("/")[1] ?? "";
console.log(currentPage);

let loading = false;
let finished = false;

// assuming `cardSectiion` is the id of your post list container
const cardSectiion = document.querySelector(".card-section");
if (!cardSectiion) {
  throw new Error("No card section found");
}

// create a sentinel div at the end of your post list
const sentinel = document.createElement("div");
cardSectiion.appendChild(sentinel);

// create a spinner div and hide it initially
const spinner = document.createElement("div");
spinner.className = "spinner";
spinner.style.display = "none";
cardSectiion.appendChild(spinner);

const observer = new IntersectionObserver(
  (entries) => {
    // if the sentinel comes into view, load more posts
    if (entries[0].isIntersecting) {
      pageNumber++;
      infiniteScroll(currentPage, pageNumber, cardSectiion, sentinel, spinner);
    }
  },
  { rootMargin: "200px" }
); // load posts 200px before the sentinel comes into view

observer.observe(sentinel);

async function fetchData(currentPage, pageNumber) {
  const res = await fetch(
    `/api/infinite-scroll?currentPage=${currentPage}&page=${pageNumber}`
  );
  const { data, status } = await res.json();
  return { data, status };
}

function createProjectCard(project) {
  return ProjectCard(
    "project",
    project.project_id,
    project.repo_link,
    project.user_id,
    project.username,
    project.created_at,
    project.updated_at,
    project.status
  );
}

function createMaterialCard(material) {
  return MaterialCard(
    "current_page",
    material.class_faculty,
    material.comments_count,
    material.created_at,
    material.document_type,
    material.education_level,
    material.file_path,
    material.format,
    material.likes_count,
    material.material_id,
    material.responded_to,
    material.semester,
    material.subject,
    material.thumbnail_path,
    material.title,
    material.user_id,
    material.updated_at,
    material.username,
    material.views_count,
    material.status
  );
}

function createRequestCard(request) {
  return RequestCard(
    "request",
    request.request_id,
    request.user_id,
    request.title,
    request.subject,
    request.description,
    request.education_level,
    request.class_faculty,
    request.semester,
    request.no_of_materials,
    request.document_type,
    request.username,
    request.created_at,
    request.status
  );
}

function parseHTML(htmlString) {
  const parser = new DOMParser();
  const doc = parser.parseFromString(htmlString, "text/html");
  return doc.body.firstElementChild;
}

function appendCard(cardSection, cardDom, sentinel) {
  cardSection.insertBefore(cardDom, sentinel);
  updateTimeAgo();
}

function handleNoMorePosts(sentinel, message) {
  sentinel.remove();
  finished = true;
  smallClientAlert(message);
}

async function infiniteScroll(
  currentPage,
  pageNumber,
  cardSection,
  sentinel,
  spinner
) {
  try {
    if (loading || finished) {
      return;
    }

    loading = true;
    spinner.style.display = "block";

    const { data, status } = await fetchData(currentPage, pageNumber);
    console.log(data);
    if (status === 200) {
      data?.forEach((project) => {
        if (currentPage === "project") {
          let card = createProjectCard(project);
          let cardDom = parseHTML(card);
          appendCard(cardSection, cardDom, sentinel);
        } else if (
          currentPage === "" ||
          currentPage === "question" ||
          currentPage === "labreport"
        ) {
          let card = createMaterialCard(project);
          let cardDom = parseHTML(card);
          appendCard(cardSection, cardDom, sentinel);
        } else if (currentPage === "request") {
          let card = createMaterialCard(project);
          let cardDom = parseHTML(card);
          appendCard(cardSection, cardDom, sentinel);
        }
      });

      if (data.length < 10) {
        console.log("No more posts to load");
        sentinel.remove();
        finished = true;
      }
    } else if (status === 404) {
      console.log("No more posts to load");
      sentinel.remove();
      finished = true;
    }
  } catch (error) {
    console.error(error);
  } finally {
    loading = false;
    spinner.style.display = "none";
  }
}
