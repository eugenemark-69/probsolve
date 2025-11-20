<?php include_once '../../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <h2 class="text-3xl font-semibold mb-2 text-blue-700">Solver Dashboard</h2>
    <div class="w-full max-w-3xl bg-white rounded shadow p-6 mt-4">
        <p class="text-gray-600">Welcome, Solver! Browse problems, submit solutions, and track your earnings.</p>
        <div class="flex gap-4 mt-6">
            <a href="/pages/solver/browse-problems.php" class="btn btn-primary">Browse Problems</a>
            <a href="/pages/solver/my-solutions.php" class="btn btn-outline-primary">My Solutions</a>
        </div>
        <h3 class="text-primary" id="solutionsCount">0</h3>
    </div>
</div>
<script>
    async function loadSolverDashboard() {
        try {
            const response = await fetch('/probsolve/backend/api/solutions/list.php');
            const solutions = await response.json();

            if (response.ok) {
                document.getElementById('solutionsCount').textContent = solutions.length;
                // Additional logic to populate dashboard stats
            } else {
                console.error('Failed to load dashboard data:', solutions.error);
            }
        } catch (error) {
            console.error('Error loading dashboard data:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadSolverDashboard);
</script>
<?php include_once '../../includes/footer.php'; ?>
