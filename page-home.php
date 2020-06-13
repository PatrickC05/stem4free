<?php get_header();
?>
<div class="container-1200 mt-6 mb-6 pt-4">
    <p class="font-m-responsive width-700 text-center line-height-12">Stem4Free is a nonprofit corporation dedicated to food rescue and food waste awareness.</p>
    <h1 class="font-xl-responsive text-center"><span id="s4f-total-counter">9,000+</span> meals rescued</h1>
    <p class="width-700 text-center font-mono font-16-lt-600"><span class="opacity-20">in <span id="s4f-top-branch">Texas (6,800+)</span>, <span id="s4f-second-branch">California (800+)</span>, and 9 other locations, </span><span class="opacity-60">with 1,234 meals rescued in the last week.</span></p>
    <script>
        fetch("https://spreadsheets.google.com/feeds/cells/1AiJWX3EvgGMYiRtnN_4aiAyNjbEKrM1Y7eq8-p-ASXw/1/public/full?alt=json")
        .then(async res => {
            const spreadsheetData = await res.json();
            const spreadsheetEntries = spreadsheetData.feed.entry.map(el => [el.gs$cell.$t, +el.gs$cell.col, +el.gs$cell.row]);
            const allLabels = spreadsheetEntries.filter(el => el[2] === 1);

            const totalLabel = allLabels.find(el => el[0] === "All");
            const totalNum = spreadsheetEntries.find(el => el[1] === totalLabel[1] && el[2] === 2);

            const otherLabels = allLabels.filter(el => el[0] !== "All");
            const otherNums = otherLabels.map(el => [el[0], +spreadsheetEntries.find(en => en[1] === el[1] && en[2] === 2)[0]]).sort((a, b) => b[1] - a[1]);

            const totalNumFormatted = d3.format(",")(totalNum[0]);
            document.getElementById("s4f-total-counter").textContent = totalNumFormatted;

            const highestBranch = otherNums[0][0];
            const highestBranchNum = d3.format(",")(otherNums[0][1]);
            document.getElementById("s4f-top-branch").textContent = highestBranch + ` (${highestBranchNum})`;

            const secondBranch = otherNums[1][0];
            const secondBranchNum = d3.format(",")(otherNums[1][1]);
            document.getElementById("s4f-second-branch").textContent = secondBranch + ` (${secondBranchNum})`;
        })
        .catch(err => console.log(err));
    </script>
</div>
<div class="width-full bg-gray-1">
    <div class="container-1200 pt-4 pb-4">
        <div class="grid-three-col grid-with-dividers">
            <div class="border-grid-child">
                <div class="font-mono-uppercase"><span>Completely Student Run</span></div>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonum.</p>
                <a href="">
                    <div class="p-3 text-center font-mono font-16 bg-gray-3"><span>Join 300+ Student Volunteers</span></div>
                </a>
            </div>
            <div class="border-grid-child">
                <div class="font-mono-uppercase"><span>25 Business Partners</span></div>
                <p>Businesses donate either regularly or whenever they have leftover food. Our volunteers pick up food from businesses and deliver it to food pantries, homeless shelters, and other organizations.</p>
                <div class="text-right font-mono font-16"><a href="">More info for businesses ></a></div>
            </div>
            <div class="border-grid-child">
                <div class="font-mono-uppercase"><span>Latest Updates & Blog Posts</span></div>
                <div class="mt-4">
                    <?php
                    $posts = get_posts(array("posts_per_page"=>4));
                    foreach ($posts as $post){
                        get_template_part("template_parts/home-post");
                    }
                    ?>
                </div>
                <div class="text-right font-mono font-16"><a href="">More Posts ></a></div>
            </div>
        </div>
    </div>
    <div class="container-1200"><!--IMAGE GALLERY--></div>
</div>

<?php
get_footer();