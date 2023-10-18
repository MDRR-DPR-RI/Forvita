@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->
@endsection

@parent

@section('page_content')
<script type="module" src="https://public.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js"></script>
<div class="main main-app p-3 p-lg-4">
    <h1> Tableau </h1>
    <div class="d-flex gap-2 mt-3 mt-md-0">
        <input type="text" id="tableauLinkInput" placeholder="Enter Tableau Link"> 
        <button class="btn btn-primary d-flex align-items-center gap-2" id="changeTableauButton">
            <i class="ri-bar-chart-2-line fs-18 lh-1"></i> Change Tableau Visualization
        </button>
        <button class="btn btn-secondary d-flex align-items-center gap-2" id="removeVisualization">
            <i class="ri-bar-chart-1-line"></i> Delete
        </button>
    </div>
    <tableau-viz class="mt-3" id="tableauViz" device="desktop" hidden="true">
    </tableau-viz>
    <h3 class="mt-3" >Example:</h3>
    <p>https://public.tableau.com/views/ThePeriodicTableofWine/periodictableauofwineEN?:language=en-US&:display_count=n&:origin=viz_share_link</p>
    <p>https://public.tableau.com/views/SolarEnergyDashboardRWFD_16900452395200/SolarEnergyDashboard?:language=en-US&:display_count=n&:origin=viz_share_link</p>
    <p style="font-weight:1000">note: ukuran blm disesuaikan brooo</p>
</div>
@endsection

@section('custom_script')
<script>
    const tableauViz = document.getElementById("tableauViz");
    const changeTableauButton = document.getElementById("changeTableauButton");
    const tableauLinkInput = document.getElementById("tableauLinkInput");
    const deleteTableauButton = document.getElementById("removeVisualization");

    // Add a click event listener to the button
    changeTableauButton.addEventListener("click", () => {
        const newLink = tableauLinkInput.value;
        if (newLink) {
            tableauViz.removeAttribute("hidden");
            tableauViz.src = newLink; // Change the visualization source
        }
    });

    deleteTableauButton.addEventListener("click", () => {
        if (tableauViz.src) {
            tableauViz.setAttribute("hidden", "true");
            tableauViz.src = ""; 
        }
    });

</script>
@endsection
