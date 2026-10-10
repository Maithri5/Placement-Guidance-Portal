<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aptitude — DSA Prep Hub</title>
  <link rel="stylesheet" href="globalstyle.css" />
</head>

<body>

<header class="site-header">
  <nav class="nav-inner">
    <div class="nav-logo">
      <span class="bracket">{</span>Logical_Hub<span class="bracket">}</span>
    </div>

    <div class="nav-links">
      <a href="codingpractice.html">Home</a>
      <a href="learning.php">Learning</a>
      <a href="company.php">Companies</a>
    </div>
  </nav>
</header>

<main class="page-layout">

  <div class="page-header">
    <h1 class="page-title">Aptitude</h1>
    <p class="page-subtitle">Click topic to expand subtopics</p>
  </div>

  <!-- SEARCH -->
  <div class="search-wrap">
    <span class="search-icon">🔍</span>
    <input type="text" id="searchInput" placeholder="Search topics..." />
  </div>

  <div class="accordion-list">

<?php
include "aptitudedb.php";

/* IMPORTANT FIX: proper ordering */
$sql = "
SELECT 
aptitude_topics.topic_name,
aptitude_links.subtopic_name,
aptitude_links.platform,
aptitude_links.link,
aptitude_links.id
FROM aptitude_topics
LEFT JOIN aptitude_links
ON aptitude_topics.id = aptitude_links.topic_id
ORDER BY aptitude_topics.id, aptitude_links.id
";

$result = $conn->query($sql);

$current_topic = "";

if ($result && $result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {

    // NEW TOPIC START
    if ($current_topic != $row['topic_name']) {

      if ($current_topic != "") {
        echo "</ul></div></div>";
      }

      echo "<div class='accordion-item'>";

      echo "<div class='accordion-header'>";
      echo "<span class='acc-title'>{$row['topic_name']}</span>";
      echo "</div>";

      echo "<div class='accordion-body'>";
      echo "<ul class='questions-list'>";

      $current_topic = $row['topic_name'];
    }

    // SUBTOPIC
    if ($row['subtopic_name']) {
      echo "<li class='question-item'>";
      echo "<a href='{$row['link']}' target='_blank'>{$row['subtopic_name']}</a>";
      echo " | {$row['platform']}";
      echo "</li>";
    }

  }

  echo "</ul></div></div>";
}

$conn->close();
?>

  </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {

  // ACCORDION
  document.querySelectorAll(".accordion-header").forEach(header => {
    header.addEventListener("click", function () {
      this.parentElement.classList.toggle("open");
    });
  });

  // SEARCH
  const searchInput = document.getElementById("searchInput");
  const items = document.querySelectorAll(".accordion-item");

  searchInput.addEventListener("keyup", function () {

    let filter = this.value.toLowerCase();

    items.forEach(item => {
      let text = item.innerText.toLowerCase();

      item.style.display = text.includes(filter) ? "" : "none";
    });

  });

});
</script>

</body>
</html>