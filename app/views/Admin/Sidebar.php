<div class="sidebar">
  <div class="items">
    <a href="#" class="sidebar-drop">
      <img
        src="<?=URLROOT . '/public/assets/dashboard.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin'?>'"
      />
      <span onclick="window.location.href = '<?=URLROOT . '/Admin'?>'">
        Dashboard
      </span></a
    >
  </div>

  <div class="items">
    <a href="#" class="sidebar-drop"
      ><img
        src="<?=URLROOT . '/public/assets/service.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin/Services'?>'"
      /><span
        onclick="window.location.href = '<?=URLROOT . '/Admin/Services'?>'"
      >
        Services </span
      ><span class="see-more" onclick='expandSideBar("sub-items-serv")'>
        &#43;</span
      ></a
    >

    <div class="sub-items" id="sub-items-serv">
      <a href="<?=URLROOT . '/Admin/Services/Add'?>">Add Service</a>
    </div>
  </div>
  <div class="items">
    <a href="#" class="sidebar-drop"
      ><img
        src="<?=URLROOT . '/public/assets/project.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin/Projects'?>'"
      /><span
        onclick="window.location.href = '<?=URLROOT . '/Admin/Projects'?>'"
      >
        Projects </span
      ><span class="see-more" onclick='expandSideBar("sub-items-proj")'>
        &#43;</span
      ></a
    >
    <div class="sub-items" id="sub-items-proj">
      <a href="<?=URLROOT . '/Admin/Projects/Add'?>">Add Project</a>
    </div>
  </div>
  <div class="items">
    <a href="#" class="sidebar-drop"
      ><img
        src="<?=URLROOT . '/public/assets/announcement.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin/Announcements'?>'"
      /><span
        onclick="window.location.href = '<?=URLROOT . '/Admin/Announcements'?>'"
      >
        Announcements </span
      ><span class="see-more" onclick='expandSideBar("sub-items-anno")'>
        &#43;</span
      ></a
    >
    <div class="sub-items" id="sub-items-anno">
      <a href="<?=URLROOT . '/Admin/Announcements/Add'?>">Add Announcement</a>
    </div>
  </div>
  <div class="items">
    <a href="#" class="sidebar-drop"
      ><img
        src="<?=URLROOT . '/public/assets/event.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin/Events'?>'"
      /><span 
      onclick="window.location.href = '<?=URLROOT . '/Admin/Events'?>'"
      >
        Events </span
      ><span class="see-more" onclick='expandSideBar("sub-items-eve")'>
        &#43;</span
      ></a
    >
    <div class="sub-items" id="sub-items-eve">
      <a href="<?=URLROOT . '/Admin/Events/Add'?>">Add Event</a>
    </div>
  </div>
  <div class="items">
    <a href="#" class="sidebar-drop"
      ><img
        src="<?=URLROOT . '/public/assets/usermanagement.png'?>"
        alt="sidebar-image"
        class="sidebar-img"
        onclick="window.location.href = '<?=URLROOT . '/Admin/Users'?>'"
      /><span 
        onclick="window.location.href = '<?=URLROOT . '/Admin/Users'?>'"
      >
        User Management </span
      ><span class="see-more" onclick='expandSideBar("sub-items-user")'>
        &#43;</span
      ></a
    >
    <div class="sub-items" id="sub-items-user">
      <a href="<?=URLROOT . '/Admin/Users'?>">Active Users</a>
      <a href="<?=URLROOT . '/Admin/Users/Disabled'?>">Disabled Users</a>
      <a href="<?=URLROOT . '/Admin/Users/Add'?>">Create new User</a>
    </div>
  </div>
</div>

<script>
  function expandSideBar(id) {
    document.getElementById(id).classList.toggle("show-drop");
  }
</script>