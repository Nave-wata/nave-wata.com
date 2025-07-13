# nave-wata.com Development Guidelines

This document provides essential coding guidelines and operational workflows for the nave-wata.com project development using Claude 4 Sonnet (Junie).

## Team Roles and Communication

### Role Definitions
- **User**: Creates ideas, makes decisions, performs final confirmations. Does not edit code or provide technical advice. Responsible for task requests and operation verification.
- **Junie (Claude 4 Sonnet)**: Executor and code creator. Generally produces good code but may use outdated or deprecated approaches. Follows instructions faithfully but has weak decision-making capabilities, which may lead to inconsistent results.
- **Gemini**: Advisor with excellent web search capabilities. Provides advice based on the latest data and information.

### Communication Languages
- **Junie ↔ Gemini**: Use English for maximum efficiency and clarity
- **Junie ↔ User**: Use Japanese for user comprehension

### Gemini Integration
When you need consultation, advice, or verification of current best practices, use Gemini:

```bash
gemini -s --yolo -p "Your prompt in English"
```

**When to consult Gemini:**
- Verifying latest best practices for PHP/Slim/Twig
- Checking for deprecated methods or libraries
- Getting advice on architectural decisions
- Researching current security practices
- Validating implementation approaches

## Project Overview

nave-wata.com is a PHP-based web application built with the following technology stack:
- **Framework**: Slim 4
- **Template Engine**: Twig
- **Dependency Injection**: PHP-DI
- **HTTP Client**: Guzzle
- **Architecture**: Clean Architecture + DDD (Domain-Driven Design)
- **External API**: WordPress GraphQL

## Essential Coding Practices

### Core Principles
1. **Clarity over brevity**: Prioritize readable code over short code
2. **Single responsibility**: Each function/class should have one clear purpose
3. **Consistent formatting**: Always run code formatting before committing
4. **Error handling**: Handle all potential errors explicitly
5. **Documentation**: Add comments for complex logic

### Modern Development Practices

#### Dependency Management
- **Regular updates**: Check for dependency updates weekly using `composer outdated`
- **Update commands**: 
  ```bash
  # Update Composer dependencies
  docker compose exec php composer update

  # Security audit
  docker compose exec php composer audit
  ```
- **Minimal dependencies**: Only add dependencies that provide significant value
- **Version pinning**: Use specific versions in production deployments

#### Testing Strategy
- **Unit tests**: Test individual functions and classes
- **Integration tests**: Test component interactions
- **End-to-end testing**: Consider adding E2E tests for critical user flows
- **Test coverage**: Aim for meaningful test coverage, not just high percentages

#### Feature Development
- **Feature flags**: Use feature flags for gradual rollouts of new functionality
- **Branch strategy**: Use feature branches for development, main branch for stable code
- **Code reviews**: All code changes should be reviewed before merging
- **Documentation**: Update documentation alongside code changes

### PHP Conventions
```php
// Naming conventions
class UserData {}              // Class names are PascalCase
public function calculateResult() {} // Method names are camelCase
private $userName;             // Property names are camelCase
const MAX_ITEMS = 10;          // Constants are SCREAMING_SNAKE_CASE
```

### Clean Architecture Structure
```php
// Domain Layer - Business Logic
namespace App\Domain\Entities;
namespace App\Domain\Repositories;
namespace App\Domain\Services;

// Application Layer - Use Cases
namespace App\Application\UseCases;
namespace App\Application\DTOs;
namespace App\Application\Queries;

// Infrastructure Layer - External System Integration
namespace App\Infrastructure\Repositories;
namespace App\Infrastructure\Services;
namespace App\Infrastructure\External;

// Interface Layer - Controllers and Presenters
namespace App\Interfaces\Controllers;
namespace App\Interfaces\Presenters;
```

## Development Workflow

### Before Starting Development
1. **Understand the task**: Read requirements carefully
2. **Consult Gemini if needed**: For latest best practices or unclear requirements
3. **Plan the implementation**: Break down into small, manageable steps
4. **Check dependencies**: Verify all dependencies are up-to-date and secure

### Code Development Process
**MANDATORY: Always create a feature branch before making any changes. Never commit directly to the main branch.**

1. **Create feature branch**: `git checkout -b feature/[descriptive-name]` (REQUIRED before any code changes)
2. **Write code**: Follow the established patterns and conventions
3. **Format code**: `docker compose exec php vendor/bin/php-cs-fixer fix`
4. **Static analysis**: `docker compose exec php vendor/bin/phpstan analyse` (fix ALL warnings)
5. **Run tests**: `docker compose exec php vendor/bin/phpunit`
6. **Build verification**: `docker compose up --build`
7. **Security scan**: Check for vulnerabilities in dependencies
8. **Git operations**: After all checks pass successfully, commit and push changes
9. **Mandatory Gemini review**: Request review from Gemini after completing any output or changes

### Git Workflow with GitHub CLI
After ensuring all builds and tests pass successfully, Junie must perform the following git operations.

#### Branch Management
```bash
# Create a new feature branch, including the issue number if applicable
git checkout -b feature/issue-123-[feature-name]

# Switch between branches
git checkout [branch-name]

# Check current branch and status
git status
```

#### Syncing with Remote
Before pushing, always sync your feature branch with the latest changes from the `main` branch to avoid conflicts.
```bash
# Fetch the latest changes from the remote
git fetch origin

# Rebase your branch on top of the latest main branch
git rebase origin/main

# If conflicts occur, DO NOT proceed. Report the conflict to the user immediately.
# On user approval, you may attempt to resolve conflicts. If not, await instructions.
```

#### Commit and Push Process
```bash
# Stage all changes
git add .

# Create commit message following Japanese format: [<Type>]: <Summary>
# The commit body should contain the details of the change.
# Change types: chore, fix, feat, refactor, style, docs, test
git commit -m "[feat]: 新しいブログ機能を追加" -m "ユーザビリティ向上のため、ブログ詳細ページに関連記事表示機能を実装しました。"
# or
git commit -m "[fix]: GraphQL接続エラーを修正" -m "WordPress GraphQL APIとの接続で発生していたタイムアウトエラーを解決しました。"
# or
git commit -m "[docs]: APIドキュメントを更新" -m "新しいエンドポイントの仕様書を追加し、既存のドキュメントを最新化しました。"

# Push changes to the remote repository
git push origin feature/issue-123-[feature-name]
```

**Commit Message Format Rules:**
- **Language**: Write in Japanese
- **Format**: `[<Type>]: <Summary>` with details in the commit body
- **Change Types** (choose based on the content of the change):
  - `chore`: Tasks that don't fit other categories (adding libraries, environment setup)
  - `fix`: Bug fixes
  - `feat`: Adding new features or functionality
  - `refactor`: Organizing code without changing functionality
  - `style`: Modifying coding style without affecting functionality
  - `docs`: Adding or updating documentation
  - `test`: Modifying or creating test code

#### Pull Request Creation
Use the GitHub CLI to create pull requests for code review.
```bash
# Create a pull request, referencing the issue in the body
gh pr create --title "feat(issue-123): [Brief PR title]" --body "Resolves #123. [Detailed description of changes, testing performed, and any notes for reviewers]"

# Alternative: Create a draft PR for work in progress
gh pr create --draft --title "[WIP] feat(issue-123): [Brief PR title]" --body "Resolves #123. [Description of current progress]"
```

### Quality Assurance Rules
- **Zero tolerance for warnings**: Fix all PHPStan and PHP CS Fixer warnings before proceeding
- **All tests must pass**: Never ignore failing tests
- **Format consistency**: Always run PHP CS Fixer
- **Build success**: Ensure clean builds without warnings
- **Mandatory Gemini review**: Always request Gemini review after completing any output or changes

### Mandatory Gemini Review Process
After completing any code output or changes, you MUST request a review from Gemini to leverage its excellent search capabilities for modern, up-to-date, and secure code practices.

**When to request Gemini review:**
- After implementing new features or components
- After making significant code changes
- After updating dependencies or configurations
- After completing any development task

**How to request review:**
```bash
gemini -s --yolo -p "Please review the following [code/implementation/changes] for modern best practices, security considerations, and potential improvements. Check for deprecated methods, outdated patterns, and suggest more current approaches: [describe your changes]"
```

## Adding New Features

### Step-by-Step Process
1. **Create route file**: Implement the functionality
2. **Add routing configuration**: Update routing settings
3. **Create controller**: Implement request processing logic
4. **Create use case**: Implement business logic
5. **Implement repository**: Implement data access layer
6. **Create template**: Create Twig templates
7. **Test thoroughly**: Verify all functionality works

### Required Components
- All features MUST have error handling
- Consistent styling with Tailwind CSS
- Proper logging and user feedback
- Documentation in Japanese

## Development Commands

### Environment Setup
```bash
# Start development server
docker compose up -d

# Restart development server
docker compose restart
```

### Code Quality
```bash
# Format code (ALWAYS run this)
docker compose exec php vendor/bin/php-cs-fixer fix

# Check for issues (fix ALL warnings)
docker compose exec php vendor/bin/phpstan analyse

# Run tests (ALL must pass)
docker compose exec php vendor/bin/phpunit

# Production build
docker compose up --build
```

## Security Guidelines

### Core Security Principles
- **Least privilege**: Grant minimal necessary permissions
- **Defense in depth**: Implement multiple layers of security
- **Regular audits**: Conduct security reviews and dependency audits
- **Secure by default**: Choose secure configurations as defaults

### PHP Security Practices
- **Input validation**: Always validate and sanitize user inputs
- **SQL injection prevention**: Use prepared statements
- **XSS prevention**: Implement output escaping
- **CSRF protection**: Implement CSRF tokens
- **Session management**: Implement proper session management

### Web Security
- **HTTPS enforcement**: Always use HTTPS in production
- **Security headers**: Implement essential security headers:
  - `Content-Security-Policy` (CSP)
  - `Strict-Transport-Security` (HSTS)
  - `X-Content-Type-Options`
  - `X-Frame-Options`
  - `Referrer-Policy`
- **Authentication**: Implement proper authentication and session management

### Docker Security
- **Least privilege**: Run container processes as a non-root user
- **Minimal base image**: Use a minimal, secure base image for containers
- **Image scanning**: Regularly scan Docker images for vulnerabilities
- **Secrets management**: Never include secrets in Docker images

## Error Prevention

### Common Mistakes to Avoid
1. **Ignoring PHPStan warnings**: Always fix ALL warnings
2. **Skipping tests**: Run tests after every change
3. **Inconsistent formatting**: Always use PHP CS Fixer
4. **Deprecated dependencies**: Consult Gemini for latest versions
5. **Poor error handling**: Handle all exceptions properly

### When to Consult Gemini
- Uncertain about current best practices
- Need to verify if a library/method is deprecated
- Require architectural guidance
- Need security best practices
- Want to confirm implementation approach

## Success Criteria

### Code Quality Checklist
- [ ] Code formatted with PHP CS Fixer
- [ ] Zero PHPStan warnings
- [ ] All tests passing
- [ ] Clean build without warnings
- [ ] Proper error handling implemented
- [ ] Japanese documentation included
- [ ] Consistent with project patterns
- [ ] Gemini review completed and recommendations addressed

### Communication Guidelines
- Use English when consulting Gemini for technical advice
- Use Japanese when communicating with the user
- Be specific and clear in all communications
- Document decisions and reasoning

The goal is to produce high-quality, maintainable code that follows current best practices. When in doubt, consult Gemini for the latest information and best practices.
