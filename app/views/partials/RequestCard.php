<!-- request card-section  -->
<div class="card-section">
    <?php foreach ($requests as $request): ?>
        <!-- request card -->
        <div class="request-card" >
            <!-- subject -->
            <p class="subject">
                <?= $request['subject']?>
            </p>
            <!-- title  -->
            <h2 class="title">
                <?= $request['title']?>
            </h2>
            <!-- request- -->
            <p class="request-details">
                <?= $request['description']?>
            </p>
            <!-- educationLevel  -->
            <div class="educationLevel">
                <span>#
                    <?= $request['education_level']?>
                </span>
                <span>#
                    <?= $request['class_faculty'] ?>
                </span>
                <?php if (!empty($request['semester'])): ?>
                    <span>#
                        <?= $request['semester'] . ' Sem' ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- responses  -->
            <div class="no-of-responses">
                <p>Responses</p>
                <span>
                    <?= $request['no_of_materials'] ?>
                </span>
            </div>
            <!-- document need ( notes, lab reports, question )  -->
            <div class="document-type-needed">
                <p>Document Need</p>
                <span>
                    <?= $request['document_type'] ?>
                </span>
            </div>

            <!-- username  -->
            <a href="/profile/<?= $request['user_id'] ?>" class="username">
                <!-- at icon @  -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" style="flex-shrink: 0"
                    viewBox="0 0 512 512">
                    <path
                        d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                    </path>
                </svg>
                <!-- username  -->
                <h3>
                    <?= $request['username'] ?>
                </h3>
            </a>

            <!-- time  -->
            <div class="time">
                <p>
                    <a href="/profile/<?= $request['user_id'] ?>" class="time-ago" data-datetime="<?= $request['created_at'] ?>"></a>
                </p>
                <!-- three dot icon -->
                        <button class="three-dot-icon" onclick="openThreeDotMenu(this)" title="three dot menu" data-copy-link="<?= SITE_DOMAIN.'/request?id='.$request['request_id'] ?>"
                data-info-link="/api/info/request/<?= $request['request_id'] ?>"
                data-report-link="/report/request/<?= $request['request_id'] ?>"
                >

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5 24">
                        <path fill="#000"
                            d="M5.217 12a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0-9.392a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0 18.783a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0" />
                    </svg>
                </button>
            </div>

            <!-- respond button, see details  -->
            <div class="button-wrapper">
                <!-- see details -->
                <button type="button" data-info-link="/api/info/request/<?= $request['request_id'] ?>" onclick="toggleSideInfo(this)" class="see-details-button">
                    • <span>See Details</span>
                </button>
                <?php 
                if($request['status'] === 'suspend'): ?>
                <div class="suspended-request">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M16 12H8"/><circle cx="12" cy="12" r="10"/></g></svg> Suspended
                </div>
                <?php else: ?>
                <form action="/material/respond/<?=$request['request_id']?>" method="post">
                <!-- respond button  -->
                <button type="submit" class="respond-button">
                    <span>Respond</span>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none'
                        stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <path d='M5 12h13M12 5l7 7-7 7' />
                    </svg>
                </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <!-- end of request card -->
    <?php endforeach; ?>
</div>