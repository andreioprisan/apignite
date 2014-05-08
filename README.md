The intent of the project was to build a Revolutionary API builder, user management, analytics and management platform, powering apignite.com.
This proof of concept was to have something read PHP classes and parse out functions and parameters, then output it to a database that could be manipulated through a UI. A very rough class parser and UI were put together to show what else could be built out, but it's by no means functional or feature complete, just a proof of concept. Also, the code is quite dirty, there were 2 other contributors who jumped on the project and contributed as part of the 24 hour TechCrunch NY hackathon 2012. Perhaps someone will find elements of this useful or perhaps it's utter garbage :)

---

Here's what a real project description for a completed product would look like:

APIgnite is a cloud Platform as a Service (PaaS) API management platform

- Pain:
Writing and maintaining APIs and backward compatibility through the product lifecycle sucks and take a lot of resources to plan and manage correctly. Every release can break existing functionality, or you’re forced to not expose new functionality through the API without adding special data entry points to the internal systems.

- Solution:
APIgnite can solve this by analyzing your code with every release and updating and versioning API definitions for you. In essence, APIgnite is an API building and management platform.

You can spend more time building kickass products and less time maintaining your API and gain traction & customers faster!

- What does it do?
1. Scan your App Codebase
2. Build & Explore your New API
3. Manage Permissions & Resources
4. Publish API & Documentation
5. Keep your API up-to-date with your codebase, instantly and effortlessly. Supercharge your product today!


- More details & screenshots:
http://andrei.oprisan.com/apignite-0-to-api-in-60-seconds

---

Make sure that you update the config/database.php with your credentials.

Copyright 2013 by Andrei Oprisan, licensed under the Simplified BSD License.
You may use it for personal and commercial purposes, just give me credit when you are.
