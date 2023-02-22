Feature:
    In order to give information about a movie
    I should be able to display a page with movie information

    Scenario:
        When I go to "/movies/le-torrent"
        Then the response status code should be 200
        And I should see "Le torrent"
        And I should see "Released at: Wednesday, November 30, 2022"
        And I should see "Genres: Thriller"
        And I should see "Country: France"
        And I should see "Price: 15.90 €"
