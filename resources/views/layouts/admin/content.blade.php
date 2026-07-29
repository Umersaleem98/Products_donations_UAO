<!-- Hero -->
      <div class="nsn-hero">
        <svg class="nsn-hero-graph" viewBox="0 0 300 180" xmlns="http://www.w3.org/2000/svg">
          <line x1="40" y1="40" x2="120" y2="90" stroke="#3B71B8" stroke-width="1.5" opacity=".5" />
          <line x1="120" y1="90" x2="210" y2="50" stroke="#3B71B8" stroke-width="1.5" opacity=".5" />
          <line x1="120" y1="90" x2="180" y2="140" stroke="#FABC4D" stroke-width="1.5" opacity=".6" />
          <line x1="210" y1="50" x2="260" y2="100" stroke="#3B71B8" stroke-width="1.5" opacity=".5" />
          <line x1="180" y1="140" x2="260" y2="100" stroke="#FABC4D" stroke-width="1.5" opacity=".6" />
          <line x1="40" y1="40" x2="70" y2="120" stroke="#3B71B8" stroke-width="1.5" opacity=".4" />
          <line x1="70" y1="120" x2="180" y2="140" stroke="#3B71B8" stroke-width="1.5" opacity=".4" />
          <circle class="node-pulse" cx="40" cy="40" r="6" fill="#FABC4D" />
          <circle class="node-pulse" cx="120" cy="90" r="9" fill="#FABC4D" style="animation-delay:.3s" />
          <circle class="node-pulse" cx="210" cy="50" r="6" fill="#8FB2E3" style="animation-delay:.6s" />
          <circle class="node-pulse" cx="180" cy="140" r="7" fill="#8FB2E3" style="animation-delay:.9s" />
          <circle class="node-pulse" cx="260" cy="100" r="6" fill="#FABC4D" style="animation-delay:1.2s" />
          <circle class="node-pulse" cx="70" cy="120" r="5" fill="#8FB2E3" style="animation-delay:1.5s" />
        </svg>
        <div class="eyebrow">NUST Sharing Network</div>
        <h1 class="font-display">Welcome back, Muhammad</h1>
        <p>Your network is active across 3 groups and 42 peers. All shared sessions are encrypted end-to-end.</p>
        <div class="d-flex gap-2 mt-3">
          <button class="btn btn-nsn-primary btn-sm"><i class="bi bi-upload me-1"></i>Share a file</button>
          <button class="btn btn-outline-light btn-sm border-1"><i class="bi bi-shield-check me-1"></i>Security
            Center</button>
        </div>
      </div>

      <!-- Stat cards -->
      <div class="row g-3 mb-3">
        <div class="col-6 col-xl-3">
          <div class="nsn-stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="nsn-stat-icon" style="background:rgba(250,188,77,.15);color:var(--nsn-primary-ink);"><i
                  class="bi bi-folder2-open"></i></div>
              <span class="badge badge-soft-success rounded-pill"><i class="bi bi-arrow-up-short"></i>12%</span>
            </div>
            <div class="nsn-stat-value">128</div>
            <div class="text-muted small">Files shared</div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="nsn-stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="nsn-stat-icon" style="background:rgba(59,113,184,.12);color:var(--nsn-secondary);"><i
                  class="bi bi-people"></i></div>
              <span class="badge badge-soft-success rounded-pill"><i class="bi bi-arrow-up-short"></i>4</span>
            </div>
            <div class="nsn-stat-value">42</div>
            <div class="text-muted small">Active peers</div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="nsn-stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="nsn-stat-icon" style="background:rgba(229,72,77,.1);color:var(--nsn-danger);"><i
                  class="bi bi-hdd-network"></i></div>
              <span class="text-muted small fw-semibold">6.4 / 10 GB</span>
            </div>
            <div class="nsn-stat-value">64%</div>
            <div class="progress mt-2" style="height:6px;">
              <div class="progress-bar" style="width:64%;background:var(--nsn-secondary);"></div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="nsn-stat-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="nsn-stat-icon" style="background:rgba(47,191,113,.12);color:var(--nsn-success);"><i
                  class="bi bi-shield-check"></i></div>
              <span class="badge badge-soft-success rounded-pill">Strong</span>
            </div>
            <div class="nsn-stat-value">92<span style="font-size:1rem;">/100</span></div>
            <div class="text-muted small">Security score</div>
          </div>
        </div>
      </div>

      <!-- Main grid -->
      <div class="row g-3">
        <!-- Activity table -->
        <div class="col-xl-8">
          <div class="nsn-card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h2 class="fs-6 fw-semibold mb-0 font-display">Recent Sharing Activity</h2>
              <a href="#" class="small text-decoration-none" style="color:var(--nsn-secondary);">View all <i
                  class="bi bi-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
              <table class="table nsn-table mb-0">
                <thead>
                  <tr>
                    <th>File</th>
                    <th>Shared with</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th class="text-end pe-3">Time</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="d-flex align-items-center gap-2">
                      <div class="file-icon"><i class="bi bi-file-earmark-zip"></i></div>Thesis_Data.zip
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="avatar-sm">AK</div>
                        <div class="avatar-sm">SN</div>
                        <div class="avatar-sm">+3</div>
                      </div>
                    </td>
                    <td class="font-mono">240 MB</td>
                    <td><span class="badge badge-soft-success rounded-pill">Encrypted</span></td>
                    <td class="text-end pe-3 text-muted">2h ago</td>
                  </tr>
                  <tr>
                    <td class="d-flex align-items-center gap-2">
                      <div class="file-icon"><i class="bi bi-file-earmark-slides"></i></div>FYP_Presentation.pptx
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="avatar-sm">HR</div>
                      </div>
                    </td>
                    <td class="font-mono">18 MB</td>
                    <td><span class="badge badge-soft-info rounded-pill">Pending</span></td>
                    <td class="text-end pe-3 text-muted">5h ago</td>
                  </tr>
                  <tr>
                    <td class="d-flex align-items-center gap-2">
                      <div class="file-icon"><i class="bi bi-file-earmark-code"></i></div>capstone-repo.tar
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="avatar-sm">BT</div>
                        <div class="avatar-sm">+7</div>
                      </div>
                    </td>
                    <td class="font-mono">76 MB</td>
                    <td><span class="badge badge-soft-success rounded-pill">Encrypted</span></td>
                    <td class="text-end pe-3 text-muted">Yesterday</td>
                  </tr>
                  <tr>
                    <td class="d-flex align-items-center gap-2">
                      <div class="file-icon"><i class="bi bi-file-earmark-pdf"></i></div>Research_Draft_v3.pdf
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="avatar-sm">MA</div>
                      </div>
                    </td>
                    <td class="font-mono">4.2 MB</td>
                    <td><span class="badge badge-soft-danger rounded-pill">Blocked</span></td>
                    <td class="text-end pe-3 text-muted">2 days ago</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Quick actions -->
          <div class="row g-3 mt-1">
            <div class="col-6 col-md-3">
              <button class="quick-action">
                <i class="bi bi-upload d-block mb-2" style="color:var(--nsn-primary-ink);"></i>
                <div class="small fw-semibold">Upload</div>
              </button>
            </div>
            <div class="col-6 col-md-3">
              <button class="quick-action">
                <i class="bi bi-person-plus d-block mb-2" style="color:var(--nsn-secondary);"></i>
                <div class="small fw-semibold">Invite peer</div>
              </button>
            </div>
            <div class="col-6 col-md-3">
              <button class="quick-action">
                <i class="bi bi-diagram-3 d-block mb-2" style="color:var(--nsn-secondary);"></i>
                <div class="small fw-semibold">New group</div>
              </button>
            </div>
            <div class="col-6 col-md-3">
              <button class="quick-action">
                <i class="bi bi-file-earmark-lock d-block mb-2" style="color:var(--nsn-primary-ink);"></i>
                <div class="small fw-semibold">Encrypt file</div>
              </button>
            </div>
          </div>
        </div>

        <!-- Security panel -->
        <div class="col-xl-4">
          <div class="nsn-card mb-3">
            <div class="card-header">
              <h2 class="fs-6 fw-semibold mb-0 font-display">Security &amp; Access</h2>
            </div>
            <div class="p-3">
              <div class="sec-item">
                <div class="sec-icon" style="background:rgba(47,191,113,.12);color:var(--nsn-success);"><i
                    class="bi bi-shield-lock"></i></div>
                <div class="flex-grow-1">
                  <div class="small fw-semibold">Two-Factor Authentication</div>
                  <div class="text-muted" style="font-size:.78rem;">Enabled via Authenticator app</div>
                </div>
                <span class="badge badge-soft-success rounded-pill">On</span>
              </div>
              <div class="sec-item">
                <div class="sec-icon" style="background:rgba(59,113,184,.12);color:var(--nsn-secondary);"><i
                    class="bi bi-lock"></i></div>
                <div class="flex-grow-1">
                  <div class="small fw-semibold">End-to-end Encryption</div>
                  <div class="text-muted" style="font-size:.78rem;">AES-256 for all shared files</div>
                </div>
                <span class="badge badge-soft-success rounded-pill">Active</span>
              </div>
              <div class="sec-item">
                <div class="sec-icon" style="background:rgba(250,188,77,.18);color:var(--nsn-primary-ink);"><i
                    class="bi bi-geo-alt"></i></div>
                <div class="flex-grow-1">
                  <div class="small fw-semibold">Last login</div>
                  <div class="text-muted font-mono" style="font-size:.78rem;">10.11.x.x · Islamabad, PK</div>
                </div>
                <span class="text-muted small">3h ago</span>
              </div>
            </div>

            <div class="accordion accordion-flush px-3 pb-3" id="secAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sessionsCollapse">
                    Active sessions (2)
                  </button>
                </h2>
                <div id="sessionsCollapse" class="accordion-collapse collapse" data-bs-parent="#secAccordion">
                  <div class="accordion-body px-0">
                    <div class="d-flex justify-content-between align-items-center small py-2 border-bottom">
                      <span><i class="bi bi-laptop me-2 text-secondary"></i>Chrome · Windows</span>
                      <span class="badge badge-soft-success rounded-pill">This device</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center small py-2">
                      <span><i class="bi bi-phone me-2 text-secondary"></i>NSN App · Android</span>
                      <button class="btn btn-sm btn-outline-danger py-0 px-2">Revoke</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="nsn-card">
            <div class="card-header">
              <h2 class="fs-6 fw-semibold mb-0 font-display">Network Health</h2>
            </div>
            <div class="p-3">
              <div class="d-flex justify-content-between small mb-1"><span>Sync bandwidth</span><span
                  class="fw-semibold">78%</span></div>
              <div class="progress mb-3" style="height:7px;">
                <div class="progress-bar" style="width:78%;background:var(--nsn-secondary);"></div>
              </div>

              <div class="d-flex justify-content-between small mb-1"><span>Peer response time</span><span
                  class="fw-semibold">96%</span></div>
              <div class="progress mb-3" style="height:7px;">
                <div class="progress-bar" style="width:96%;background:var(--nsn-primary);"></div>
              </div>

              <div class="d-flex justify-content-between small mb-1"><span>Threat filter uptime</span><span
                  class="fw-semibold">100%</span></div>
              <div class="progress" style="height:7px;">
                <div class="progress-bar" style="width:100%;background:var(--nsn-success);"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
