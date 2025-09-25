# Laravel Dev MCP
This package is just a copy of the "Searching Documentation" tool from [Laravel Boost](https://boost.laravel.com).

I hope this package will help people who just want to dig deeper into the Laravel Documentation without editing code or executing commands.

## Installation
### Claude Desktop
1. **Open the setting**
    - Go to menu -> Settings -> Developer -> Edit Config
2. **Add to config**
    ```json
    {
      "mcpServers": {
        "laravel-dev": {
          "command": "docker",
          "args": ["run", "--rm", "-i", "trungld/laravel-dev-mcp:latest"]
        }
      }
    }
    ```
3. **Restart Claude Desktop**

### Jetbrain
#### For Junie
1. **Open the settings**
    - Go to Settings -> Tools -> Junie -> MCP Settings -> (+)
2. **Add to config**
   ```json
    {
      "mcpServers": {
        "laravel-dev": {
          "command": "docker",
          "args": ["run", "--rm", "-i", "trungld/laravel-dev-mcp:latest"]
        }
      }
    }
    ```
3. **Save the config**

#### For Github Copilot
1. **Open the settings**
    - Go to Settings -> Tools -> Github Copilot -> Model Context Protocol (MCP) -> Configure
2. **Add to config**
   ```json
    {
      "mcpServers": {
        "laravel-dev": {
          "command": "docker",
          "args": ["run", "--rm", "-i", "trungld/laravel-dev-mcp:latest"]
        }
      }
    }
    ```
3. **Save the config**

## License
MIT
