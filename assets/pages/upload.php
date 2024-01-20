<?php
req_once('assets/components/Header.php', ['page_title' => 'Upload - '.SITE_NAME,'stylesheets' => ['upload'],'scripts' => ['toast','threeDotMenu','sideInfo','searchOverlay','previewUpload']]);
req_once('assets/components/SideNav.php',['current_page' => 'none']);
?>
    <main class="container">
        <?php req_once('assets/components/MenuHeader.php',['current_page' => 'profile']);?>
        <section>
            <!-- upload study materials title -->
            <div class="title-label">

                <div>
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.3"
                                d="M21 15.9983V9.99826C21 7.16983 21 5.75562 20.1213 4.87694C19.3529 4.10856 18.175 4.01211 16 4H8C5.82497 4.01211 4.64706 4.10856 3.87868 4.87694C3 5.75562 3 7.16983 3 9.99826V15.9983C3 18.8267 3 20.2409 3.87868 21.1196C4.75736 21.9983 6.17157 21.9983 9 21.9983H15C17.8284 21.9983 19.2426 21.9983 20.1213 21.1196C21 20.2409 21 18.8267 21 15.9983Z"
                                fill="currentColor"></path>
                            <path
                                d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.25 10.5C6.25 10.0858 6.58579 9.75 7 9.75H17C17.4142 9.75 17.75 10.0858 17.75 10.5C17.75 10.9142 17.4142 11.25 17 11.25H7C6.58579 11.25 6.25 10.9142 6.25 10.5ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 17.5C8.25 17.0858 8.58579 16.75 9 16.75H15C15.4142 16.75 15.75 17.0858 15.75 17.5C15.75 17.9142 15.4142 18.25 15 18.25H9C8.58579 18.25 8.25 17.9142 8.25 17.5Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.3"
                                d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z"
                                fill="currentColor"></path>
                            <path
                                d="M15.7997 2.20999C15.3897 1.79999 14.6797 2.07999 14.6797 2.64999V6.13999C14.6797 7.59999 15.9197 8.80999 17.4297 8.80999C18.3797 8.81999 19.6997 8.81999 20.8297 8.81999C21.3997 8.81999 21.6997 8.14999 21.2997 7.74999C19.8597 6.29999 17.2797 3.68999 15.7997 2.20999Z"
                                fill="currentColor"></path>
                            <path
                                d="M13.5 13.75H7.5C7.09 13.75 6.75 13.41 6.75 13C6.75 12.59 7.09 12.25 7.5 12.25H13.5C13.91 12.25 14.25 12.59 14.25 13C14.25 13.41 13.91 13.75 13.5 13.75Z"
                                fill="currentColor"></path>
                            <path
                                d="M11.5 17.75H7.5C7.09 17.75 6.75 17.41 6.75 17C6.75 16.59 7.09 16.25 7.5 16.25H11.5C11.91 16.25 12.25 16.59 12.25 17C12.25 17.41 11.91 17.75 11.5 17.75Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.3"
                                d="M21.97 6.41V12.91H2V6.41C2 3.98 3.98 2 6.41 2H17.56C19.99 2 21.97 3.98 21.97 6.41Z"
                                fill="currentColor"></path>
                            <path
                                d="M2 12.9199V13.1199C2 15.5599 3.98 17.5299 6.41 17.5299H10.25C10.8 17.5299 11.25 17.9799 11.25 18.5299V19.4999C11.25 20.0499 10.8 20.4999 10.25 20.4999H7.83C7.42 20.4999 7.08 20.8399 7.08 21.2499C7.08 21.6599 7.41 21.9999 7.83 21.9999H16.18C16.59 21.9999 16.93 21.6599 16.93 21.2499C16.93 20.8399 16.59 20.4999 16.18 20.4999H13.76C13.21 20.4999 12.76 20.0499 12.76 19.4999V18.5299C12.76 17.9799 13.21 17.5299 13.76 17.5299H17.57C20.01 17.5299 21.98 15.5499 21.98 13.1199V12.9199H2Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                </div>

                <h2 class="title">
                    Upload Study Materials
                </h2>
    
                <p class="message">
                    Fill the form below to upload your study materials. <br>
                    Help others , others will help you.
                </p>
            </div>

            <!-- form-section  -->
            <div class="form-section">
                <h2 class="form-heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M12.238 3.64a1.854 1.854 0 0 0-1.629-1.628l-.8.8a3.367 3.367 0 0 1 1.63 1.628zM4.74 7.88l3.87-3.868a1.854 1.854 0 0 1 1.628 1.629L6.369 9.51a1.5 1.5 0 0 1-.814.418l-1.48.247l.247-1.48a1.5 1.5 0 0 1 .418-.814ZM9.72.78l-2 2l-4.04 4.04a3 3 0 0 0-.838 1.628L2.48 10.62a1 1 0 0 0 1.151 1.15l2.17-.36a3 3 0 0 0 1.629-.839l4.04-4.04l2-2c.18-.18.28-.423.28-.677A3.353 3.353 0 0 0 10.397.5c-.254 0-.498.1-.678.28ZM2.75 13a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5z" clip-rule="evenodd"/></svg>
                    Study Materials
                </h2>
                <p class="form-info">
                    Details must be Correct, Complete and Concise [CCC], so that other
                    students can understand your materials.
                </p>
                <!-- form -->
                <form action="assets/php/actions.php?uploadStudyMaterial" class="search-form" id="uploadForm" method="POST" enctype="multipart/form-data">

                    <!-- responding to if comming from respond button -->

                    <!-- <div class="responding-to">
                        <div>Responding to</div>
                        <p>Rayyan Balami</p>
                    </div> -->

                    <!-- title (required)-->
                    <div class="title">
                        <label for="title">Title</label>
                        <input type="text" placeholder="functions in C programming language." required name="title"
                            id="title" value="<?php echo isset($_SESSION['old']['title']) ? $_SESSION['old']['title'] : ''; ?>" />
                    </div>

                    <!-- description (required)-->
                    <div class="description col-span-full">
                        <label for="description">Description</label>
                        <textarea required id="description" name="description" rows="3"><?php echo isset($_SESSION['old']['description']) ? $_SESSION['old']['description'] : ''; ?></textarea>

                        <p class="mt-2 text-sm text-gray-600">
                            Describe what you are covering in your study materials.
                        </p>
                    </div>

                    <!-- document-type (required)-->
                    <div class="document-type">
                        <label for="document-type">Document Type</label>
                        <select name="document-type" id="document-type" required value="<?php echo isset($_SESSION['old']['document-type']) ? $_SESSION['old']['document-type'] : ''; ?>">
                            <option value="" disabled selected>Select an option...</option>
                            <option value="note" name="document-type">Note</option>
                            <option value="question" name="document-type">Question</option>
                            <option value="lab report" name="document-type">Lab Report</option>
                        </select>
                        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- Format ? (required)-->
                    <div class="format">
                        <label for="format">Format </label>
                        <select name="format" id="format" required value="<?php echo isset($_SESSION['old']['format']) ? $_SESSION['old']['format'] : ''; ?>">
                            <option value="" disabled selected>Select an option...</option>
                            <option value="handwritten" name="format">Handwritten</option>
                            <option value="typed" name="format">Typed</option>
                            <option value="photo" name="format">Photo</option>
                        </select>
                        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- Education Level (required)-->
                    <div class="education-level">
                        <label for="education-level">Education
                            Level</label>
                        <select name="education-level" id="education-level" required value="<?php echo isset($_SESSION['old']['education-level']) ? $_SESSION['old']['education-level'] : ''; ?>">
                            <option value="" disabled selected>Select an option...</option>
                            <option value="School" name="education-level">School</option>
                            <option value="+2" name="education-level">+2</option>
                            <option value="Bachelor" name="education-level">Bachelor</option>
                            <option value="Master" name="education-level">Master</option>
                            <option value="PhD" name="education-level">PhD</option>
                        </select>
                        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" cprofile="evenodd"
                                    d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- semester (optional) -->
                    <div class="semester">
                        <label for="semester">Semester (if
                            applicable)</label>
                        <select name="semester" id="semester"value="<?php echo isset($_SESSION['old']['semester']) ? $_SESSION['old']['semester'] : ''; ?>">
                            <option value="" disabled selected>Select an option...</option>
                            <option value="first" name="semester">First</option>
                            <option value="second" name="semester">Second</option>
                            <option value="third" name="semester">Third</option>
                            <option value="fourth" name="semester">Fourth</option>
                            <option value="fifth" name="semester">Fifth</option>
                            <option value="sixth" name="semester">Sixth</option>
                            <option value="seventh" name="semester">Seventh</option>
                            <option value="eighth" name="semester">Eighth</option>
                        </select>
                        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                    </div>

                    <!-- subject (required)-->
                    <div class="subject">
                        <label for="subject">Subject</label>
                        <input type="text" placeholder="C Programming" required name="subject" id="subject" value="<?php echo isset($_SESSION['old']['subject']) ? $_SESSION['old']['subject'] : ''; ?>" />
                    </div>

                    <!-- class/faculty (required)-->
                    <div class="class">
                        <label for="class">Class/ Faculty</label>
                        <input type="text" placeholder="Class 10, Management, Science, BCA, BCSIT, MCA etc" required name="class" id="class" value="<?php echo isset($_SESSION['old']['class']) ? $_SESSION['old']['class'] : ''; ?>" />
                    </div>

                    <!-- author / source / credits (required)-->
                    <div class="author">
                        <label for="author">Author / Source / Credits [ Be Truthful ]</label>
                        <input type="text" placeholder="Rayyan Balami" required name="author" id="author" value="<?php echo isset($_SESSION['old']['author']) ? $_SESSION['old']['author'] : ''; ?>" />
                    </div>

                    <!-- upload thumbnail (required)-->
                    <div class="file-thumbnail">
                        <label for="file-thumbnail">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M18.512 10.077c0 .738-.625 1.337-1.396 1.337c-.77 0-1.395-.599-1.395-1.337c0-.739.625-1.338 1.395-1.338s1.396.599 1.396 1.338" />
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M18.036 5.532c-1.06-.137-2.414-.137-4.123-.136h-3.826c-1.71 0-3.064 0-4.123.136c-1.09.14-1.974.437-2.67 1.104S2.29 8.149 2.142 9.195C2 10.21 2 11.508 2 13.147v.1c0 1.64 0 2.937.142 3.953c.147 1.046.456 1.892 1.152 2.559c.696.667 1.58.963 2.67 1.104c1.06.136 2.414.136 4.123.136h3.826c1.71 0 3.064 0 4.123-.136c1.09-.14 1.974-.437 2.67-1.104s1.005-1.514 1.152-2.559C22 16.184 22 14.886 22 13.248v-.1c0-1.64 0-2.937-.142-3.953c-.147-1.046-.456-1.892-1.152-2.559c-.696-.667-1.58-.963-2.67-1.104M6.15 6.858c-.936.12-1.475.346-1.87.724c-.393.377-.629.894-.755 1.791c-.1.72-.123 1.619-.128 2.795l.47-.395c1.125-.942 2.819-.888 3.875.124l3.99 3.825a1.2 1.2 0 0 0 1.491.124l.278-.187a3.606 3.606 0 0 1 4.34.25l2.407 2.077c.098-.264.173-.579.227-.964c.128-.916.13-2.124.13-3.824c0-1.7-.002-2.909-.13-3.825c-.126-.897-.362-1.414-.756-1.791c-.393-.378-.933-.604-1.869-.724c-.956-.124-2.216-.125-3.99-.125h-3.72c-1.774 0-3.034.001-3.99.125"
                                    clip-rule="evenodd" />
                                <path fill="currentColor"
                                    d="M17.087 2.61c-.86-.11-1.955-.11-3.32-.11h-3.09c-1.364 0-2.459 0-3.318.11c-.89.115-1.633.358-2.222.92a2.9 2.9 0 0 0-.724 1.12c.504-.23 1.074-.366 1.714-.45c1.085-.14 2.47-.14 4.22-.14h3.915c1.749 0 3.134 0 4.219.14c.559.073 1.064.186 1.52.366a2.875 2.875 0 0 0-.693-1.035c-.589-.563-1.331-.806-2.221-.92"
                                    opacity=".5" />
                            </svg>
                            <span>Upload a Image or drag and drop [ 21:9 ratio ]</span>
                            <p>JPG, JPEG, PNG up to 10MB</p>
                        </label>
                        <input id="file-thumbnail" name="file-thumbnail" type="file" accept=".jpg,.jpeg,.png" required hidden/>
                    </div>


                    <!---upload pdf file (required) -->
                    <div class="file-document">
                        <label for="file-document" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <g fill="currentColor">
                                    <path d="M208 88h-56V32Z" opacity=".2" />
                                    <path
                                        d="M224 152a8 8 0 0 1-8 8h-24v16h16a8 8 0 0 1 0 16h-16v16a8 8 0 0 1-16 0v-56a8 8 0 0 1 8-8h32a8 8 0 0 1 8 8M92 172a28 28 0 0 1-28 28h-8v8a8 8 0 0 1-16 0v-56a8 8 0 0 1 8-8h16a28 28 0 0 1 28 28m-16 0a12 12 0 0 0-12-12h-8v24h8a12 12 0 0 0 12-12m88 8a36 36 0 0 1-36 36h-16a8 8 0 0 1-8-8v-56a8 8 0 0 1 8-8h16a36 36 0 0 1 36 36m-16 0a20 20 0 0 0-20-20h-8v40h8a20 20 0 0 0 20-20M40 112V40a16 16 0 0 1 16-16h96a8 8 0 0 1 5.66 2.34l56 56A8 8 0 0 1 216 88v24a8 8 0 0 1-16 0V96h-48a8 8 0 0 1-8-8V40H56v72a8 8 0 0 1-16 0m120-32h28.69L160 51.31Z" />
                                </g>
                            </svg>
                            <span>Upload a file or drag and drop</span>

                            <p>PDF up to 10MB</p>
                        </label>
                        <input id="file-document" name="file-document" type="file" accept=".pdf" required
                            hidden />
                        <p>
                            Use copyright watermark, names, signatures etc in your PDF.
                            If someone is using your materials without giving you credits, report it. <br>
                        </p>
                    </div>



                    <!-- save button -->
                    <button type="submit" name="submit">
                        Upload / Respond
                    </button>
            </form>

            </div>

            <!-- footer -->
            <footer>
               
                <!-- footer content  -->
                <div class="footer-content">
                    <p>© Copyright 2021. All Rights Reserved.</p>

                    <div>
                        <a href="t&c.html">Tearms & Conditions</a>・
                        <a href="#">Privacy</a>・
                        <a href="#">Cookies</a>
                    </div>

                    <div>
                        Developers : <a href="#">Rayyan Balami</a> &amp;
                        <a href="#">Satish Chaudhary</a>
                    </div>
                </div>
            </footer>
        </section>

    </main>
<?php
req_once('assets/components/SearchOverlay.php');

req_once('assets/components/Footer.php');
?>