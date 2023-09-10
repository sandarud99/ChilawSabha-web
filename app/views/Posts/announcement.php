<?php if(!(($_SESSION['role'] ?? 'Guest') == 'Admin')): ?>
<script>
    setTimeout(()=>fetch('<?=URLROOT . '/Posts/Viewed/' . $data['ann'][0]['post_id'] ?? '0'?>').then(res=>res.json()).then(console.log).catch(console.log),2000);
</script>
<?php endif;?>
<div class="content">
<?php
[$announcement, $images, $attachments, $edits] = $data['ann'] !== false ? $data['ann'] : [false, false, false, false];
$types = $data['types'] ?? [];
$formatter = new IntlDateFormatter(
    'en_US',
    IntlDateFormatter::LONG,
    IntlDateFormatter::SHORT,
);
if (empty($announcement)): ?>
    <h1>
        Announcement not found
    </h1>
<?php else: ?>
    <h1 <?=(($announcement['pinned'] ?? 0) == 1) ? 'class="pinned"' : ''?>>
        Announcement : <?=$announcement['title']?>
    </h1>
    <hr>
    <div class="row">
        <div class="author">
            <?=$announcement['posted_by'] ?? 'Not found'?>
        </div>
        <div class="date">
            <?=$formatter->format(IntlCalendar::fromDateTime($announcement['posted_time'] ?? '2022-01-01', null))?>
        </div>
        <a class="category"
        href="<?=URLROOT . '/Posts/Announcements?category=' . ($announcement['ann_type_id'] ?? '0')?>"
        > <?=$announcement['ann_type'] ?? 'Not Found'?> </a>
        <div class="views">
            <?=$announcement['views'] ?? 'Not found'?>
        </div>
    </div>
    <?php if (($_SESSION['role'] ?? 'visitor') == 'Admin'): ?>
    <div class="btn-column">
        <a href="<?=URLROOT . '/Admin/Announcements/View/' . $announcement['post_id']?>" class="btn views bg-blue">Go to Admin View Mode</a>
        <a href="<?=URLROOT . '/Admin/Announcements/Edit/' . $announcement['post_id']?>" class="btn edit bg-yellow">Edit</a>
    </div>
    <?php endif;?>
    <div class="post-details">
        <summary class="shadow">
            <?=$announcement['short_description'] ?? 'Not found'?>
        </summary>
        <p>
           &emsp;&emsp;&emsp;&emsp;<?=$announcement['content'] ?? 'Not found'?>
        </p>
        </div>
    </div>
<?php if (!empty($attachments)): ?>
    <div class="attachments-container shadow">
        <h4>Attached Files</h4>
        <div class="attachments">
            <?php foreach ($attachments as $attachment):
    $name = $attachment['name'] ?? '';
    $orig = $attachment['orig'] ?? '';?>
	                <a href="<?=URLROOT . '/Downloads/file/' . $name?>"><?=$orig?></a>
	            <?php endforeach;?>
        </div>
    </div>
<?php endif;
if (!empty($images)):
    $photos = [];
    foreach ($images as $image):
        $name = $image['name'] ?? '';
        $orig = $image['orig'] ?? '';
        $photos[] = URLROOT . '/public/upload/' . $name;
    endforeach;
    Slideshow::Slideshow($photos, 'shadow');
endif;
if (!empty($edits)): ?>
<hr>
<div class="edit-container">
<h3>Edit History</h3>
</div>
<?php $current = $announcement;
$aliases = [
    'ann_type' => 'Announcement type',
    'title' => 'Announcement title',
    'short_description' => 'Summary',
    'content' => 'Announcement content',
];
$hide_pin = [
    'hidden' => [
        1 => '<b>Re published</b> the announcement to public viewing',
        0 => '<b>Removed</b> the announcement from public viewing',
    ],
    'pinned' => [
        1 => '<b>Unpinned</b> the announcement from the frontpage',
        0 => '<b>Pinned</b> the announcement to the frontpage',
    ],
];

$formatter = new IntlDateFormatter(
    'en_US',
    IntlDateFormatter::LONG,
    IntlDateFormatter::SHORT,
);
foreach ($edits as $edit):
    $edited_by = $edit['edited_by'] ?? 'Not found';
    $edited_time = $edit['edited_time'] ?? false;
    if ($edited_time !== false) {
        $date = IntlCalendar::fromDateTime($edited_time, null);
        $edited_time = $formatter->format($date);
    } else {
        $edited_time = 'ERROR RETRIEVING DATE';
    }
    unset($edit['edited_by']);
    unset($edit['edited_time']);?>
	    <div class="edit-container">
	        <div class="edit">
	            Edited On <span class="time"><?=$edited_time?></span> by
	            <?=$edited_by?>
	        </div>
	        <ul>
	        <?php
    foreach ($edit as $field => $value):
        if (!is_null($value) && $current[$field] != $value): ?>
		            <li>
		                <?php if ($field != 'hidden' && $field != 'pinned'): ?>
		                    changed
		                    <b><?=$aliases[$field] ?? 'UNDEFINED'?></b>
		                    from
		                    "<?=$value?>"
		                    to
		                    "<?=$current[$field]?>".
		                <?php else: ?>
	                    <?=$hide_pin[$field][$value] ?? 'UNDEFINED ACTION'?>
	                <?php endif;?>
            </li>
                <?php $current[$field] = $value;
endif;
endforeach;?>
        </ul>
    </div>
    <?php endforeach;?>
<?php endif;?>
<?php endif;?>
</div>
<script>
    const edits = document.querySelectorAll('.edit-container')
    const check = {
        container:document.createElement('div'),
        children:document.createElement('div')
    };
    check.container.innerHTML = "This announcement has been edited. Click here to view the edit history."
    check.container.classList.add('toggle');
    check.children.classList.add('invisible');
    edits[0].parentNode.insertBefore(check.children,edits[0]);
    edits[0].parentNode.insertBefore(check.container,edits[0]);
    // Add see more option instead of printing all
    edits.forEach((edit,index)=>{
        check.children.appendChild(edit);
    });
    const changeVisibility = () => {
        check.children.classList.toggle('invisible')
        if(!check.children.classList.contains('invisible')) {
            check.container.innerHTML = "See less";
        } else {
            check.container.innerHTML = "This announcement has been edited. Click here to view the edit history.";
        }
    }
    check.container.addEventListener('click',changeVisibility)
</script>
<style>
    .content * {
        transition: transform .2s ease-in-out;
        transform-origin: top;
    }
    .toggle {
        box-sizing: border-box;
        width: 100%;
        text-align: right;
        color: var(--black);
        text-decoration: underline;
        background:linear-gradient(to right,rgba(255,255,255,0),var(--blue));
        border-radius: 1rem;
        padding: .2rem 1rem;
    }
    .invisible {
        height: 0;
        transform: scaleY(0);
    }
</style>