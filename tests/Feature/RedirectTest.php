<?php

namespace Tests\Feature;

use App\Models\Archive;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    /**
     * Test redirection of current-issue paperlist and legacy pages.
     */
    public function test_current_issue_redirects(): void
    {
        // 1. Get the latest issue from the DB to check redirect destination
        $latestIssue = Archive::query()
            ->select(['year', 'volume', 'issue'])
            ->orderByDesc('year')
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->first();

        $this->assertNotNull($latestIssue);

        // 2. Test /current-issue redirects to the latest issue (302)
        $response = $this->get('/current-issue');
        $response->assertStatus(302);
        $response->assertRedirect("/current-issue/{$latestIssue->year}/volume-{$latestIssue->volume}/issue-{$latestIssue->issue}");

        // 3. Test /current-issue/paperlist without params redirects to the latest issue (302)
        $response = $this->get('/current-issue/paperlist');
        $response->assertStatus(302);
        $response->assertRedirect("/current-issue/{$latestIssue->year}/volume-{$latestIssue->volume}/issue-{$latestIssue->issue}");

        // 4. Test /current-issue/paperlist with params redirects (301) to the friendly URL
        $response = $this->get('/current-issue/paperlist?year=2023&volume=2&issue=3');
        $response->assertStatus(301);
        $response->assertRedirect('/current-issue/2023/volume-2/issue-3');

        // 5. Test /current-issue/paper-details?paperid=29 redirects (301) to its canonical archive URL
        $response = $this->get('/current-issue/paper-details?paperid=29');
        $response->assertStatus(301);
        $response->assertRedirect('/archives/ml-based-hand-gesture-recognition');

        // 6. Test /current-issue/{identifier} with non-canonical identifier redirects (301) to /current-issue/{canonical_slug}
        $response = $this->get('/current-issue/29');
        $response->assertStatus(301);
        $response->assertRedirect('/current-issue/ml-based-hand-gesture-recognition');

        // 7. Test /archives/{identifier} with non-canonical identifier redirects (301) to /archives/{canonical_slug}
        $response = $this->get('/archives/29');
        $response->assertStatus(301);
        $response->assertRedirect('/archives/ml-based-hand-gesture-recognition');
    }

    /**
     * Test that papers on the issue listing page are sorted by page numbers ascending.
     */
    public function test_paper_listing_order(): void
    {
        $response = $this->get('/archives/2023/volume-2/issue-3');
        $response->assertStatus(200);

        // We can inspect the order of the paper titles in the returned HTML view.
        $html = $response->getContent();
        
        $pos1 = strpos($html, 'Ml Based Hand Gesture Recognition');
        $pos2 = strpos($html, 'Enhancing Cloud Computing using Green Computation');
        $pos3 = strpos($html, 'Research into the world of Cloud-Virtual Reality');

        $this->assertNotFalse($pos1, 'Ml Based Hand Gesture Recognition title not found');
        $this->assertNotFalse($pos2, 'Enhancing Cloud Computing using Green Computation title not found');
        $this->assertNotFalse($pos3, 'Research into the world of Cloud-Virtual Reality title not found');

        $this->assertTrue($pos1 < $pos2, 'Gesture Recognition should appear before Green Computation');
        $this->assertTrue($pos2 < $pos3, 'Green Computation should appear before Virtual Reality');
    }
}
