let pageNumber = 1;
let currentPage = window.location.pathname.split('/')[1]??'';
console.log(currentPage);

let loading = false;
let finished = false;

// assuming `cardSectiion` is the id of your post list container
const cardSectiion = document.querySelector('.card-section');

// create a sentinel div at the end of your post list
const sentinel = document.createElement('div');
cardSectiion.appendChild(sentinel);

// create a spinner div and hide it initially
const spinner = document.createElement('div');
spinner.className = 'spinner';
spinner.style.display = 'none';
cardSectiion.appendChild(spinner);

const observer = new IntersectionObserver((entries) => {
    // if the sentinel comes into view, load more posts
    if (entries[0].isIntersecting) {
        pageNumber++;
        loadPosts();
    }
}, { rootMargin: '200px' }); // load posts 200px before the sentinel comes into view

observer.observe(sentinel);

async function loadPosts() {
    if (loading || finished) return;
    loading = true;
    // show the spinner
    spinner.style.display = 'block';
    console.log('Loading more posts...');
    // load more posts using AJAX
    // fetch(`/api/infinite-scroll?currentPage=${currentPage}&page=${pageNumber}`)
    //     .then(response => response.json())
    //     .then(data => {
    //       console.log(data);
    //     })
    //     .catch(error => console.error(error));
    try {
        const res = await fetch(`/api/infinite-scroll?currentPage=${currentPage}&page=${pageNumber}`);
        const { data, status } = await res.json();
        if (status === 200) {
            if (currentPage === 'project') {
                console.log(data);
                data?.forEach((project) => {
                    // create a project card
                    const projectCardHTML = ProjectCard(
                        'project',
                        project.project_id,
                        project.repo_link,
                        project.user_id,
                        project.username,
                        project.created_at,
                        project.updated_at,
                        project.status
                    );
                    
                    // create a new DOMParser
                    const parser = new DOMParser();
                    // parse the HTML string to a Document
                    const doc = parser.parseFromString(projectCardHTML, 'text/html');
                    // get the first Element in the body of the Document
                    const projectCard = doc.body.firstElementChild;
                    
                    // append the project card before the sentinel
                    // project card is a string containing the HTML of the project card
                    cardSectiion.insertBefore(projectCard, sentinel);
                    
                })
            }




            
            if (data.length < 10) {
                // if no more posts to load, remove the sentinel
                sentinel.remove();
                // set finished to true
                finished = true;
                smallClientAlert('No more posts to load');
            }
        } else if (status === 404) {
            // if no more posts to load, remove the sentinel
            sentinel.remove();
            // set finished to true
            finished = true;
            // show a message
            smallClientAlert('No posts found');
            
        }
    }
    catch (error) {
        console.error(error);
    }
    finally {
        loading = false;
        spinner.style.display = 'none';
    }

}