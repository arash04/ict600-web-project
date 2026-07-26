<h2 class="page-title">Reports</h2>

<div class="mb-3">
    <label class="form-label">Select Report Type</label>
    <select id="reportType" class="form-select">
        <option value="payment">Payment Report</option>
        <option value="student">Student Report</option>
        <option value="course">Course Report</option>
        <option value="tutor">Tutor Report</option>
    </select>
</div>

<div id="reportResult">
    <p class="text-muted">Select a report to view data.</p>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url('js/admin_report.js') ?>"></script>
