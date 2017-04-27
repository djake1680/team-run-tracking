# team-run-tracking

Team Run Tracking is a project that I'm building where you can track your running goals alone or with a team.  I really wanted to build in a login tool with authentication and validation and have completed this step.  

Create Database - MySQL
    Database Setup

	1. Users
		a. user_id
		b. First name
		c. Last name
		d. Username
		e. Password
		f. Email address
        g. user level
        h. city
        i. state
	2. Teams
		a. Unique Team ID
		b. Team Name
		c. Runners
		d. Mile Goal
	3. Running Data
		a. Unique User ID
		b. Run Date
		c. Run Miles
		d. Run Time
		e. RunCity
		f. RunState
		g. Teamname(in case user is in more than one team)
	4. Team/user
		a. Unique Team ID
        b. Unique User ID
