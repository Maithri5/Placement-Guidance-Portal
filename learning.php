<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Learning Mode — DSA Prep Hub</title>
  <link rel="stylesheet" href="globalstyle.css" />
</head>
<body>
 
  <!-- ── Navigation ── -->
  <header class="site-header">
    <nav class="nav-inner">
      <div class="nav-logo">
        <span class="bracket">{</span>DSA_Hub<span class="bracket">}</span>
      </div>
      <div class="nav-links">
        <a href="codingpractice.html">Home</a>
        <a href="learning.php" class="active">Learning</a>
        <a href="company.php">Companies</a>
      </div>
    </nav>
  </header>
 
  <main class="page-layout">
 
    <!-- ── Page Header ── -->
    <div class="page-header">
<a href="#" onclick="goBack()" class="back-link">
  ← Back
</a>
      <h1 class="page-title">Learning <span>Mode</span></h1>
      <p class="page-subtitle">Select a topic to expand its questions. Only one topic stays open at a time.</p>
    </div>
 
    <!-- ── Search ── -->
    <div class="search-wrap">
      <span class="search-icon">🔍</span>
      <input
        type="text"
        id="searchInput"
        placeholder="Search topics or questions…"
        autocomplete="off"
        spellcheck="false"
      />
      <button class="search-clear" id="searchClear" title="Clear search">✕</button>
    </div>

<div class="difficulty-filter">

  <button class="filter-btn active" data-difficulty="all">
    All
  </button>

  <button class="filter-btn" data-difficulty="easy">
    Easy
  </button>

  <button class="filter-btn" data-difficulty="medium">
    Medium
  </button>

  <button class="filter-btn" data-difficulty="hard">
    Hard
  </button>

</div>

    <div class="accordion-list">

      


<?php

include "dsadb.php";

$sql = "

SELECT 
topics.topic_name,
questions.question_text,
questions.difficulty,
questions.platform,
questions.question_link

FROM topics

LEFT JOIN questions
ON topics.id = questions.topic_id

ORDER BY topics.id

";

$result = $conn->query($sql);

$current_topic = "";

while($row = $result->fetch_assoc()) {

if($current_topic != $row['topic_name']) {

if($current_topic != "") {
echo "</ul></div></div>";
}

echo "<div class='accordion-item'>";

echo "<div class='accordion-header'>";

echo "<span class='acc-title'>";
echo $row['topic_name'];
echo "</span>";

echo "</div>";

echo "<div class='accordion-body'>";
echo "<ul class='questions-list'>";

$current_topic = $row['topic_name'];
}

if($row['question_text']) {

echo "<li class='question-item'>";

echo "<a href='" .
$row['question_link'] .
"' target='_blank'>";

echo $row['question_text'];

echo "</a>";
$difficulty = strtolower($row['difficulty']);

echo "<span class='difficulty-tag " . 
$difficulty . "'>";

echo $row['difficulty'];

echo "</span>";

echo " | " . $row['platform'];

echo "</li>";

}

}

echo "</ul></div></div>";

$conn->close();

?>

</div>
</main>
<script src="script.js"></script>
</body>
</html>