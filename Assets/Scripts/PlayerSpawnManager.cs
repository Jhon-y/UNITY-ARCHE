using UnityEngine;
using UnityEngine.SceneManagement;

public class PlayerSpawnManager : MonoBehaviour
{
    private void Awake()
    {
        DontDestroyOnLoad(gameObject);

        // Garante que não haverá 2 Players (duplicados entre cenas)
        GameObject[] players = GameObject.FindGameObjectsWithTag("Player");
        if (players.Length > 1)
        {
            Destroy(gameObject);
            return;
        }

        // Escuta evento de carregamento de cena
        SceneManager.sceneLoaded += OnSceneLoaded;
    }

    private void OnSceneLoaded(Scene scene, LoadSceneMode mode)
    {
        string nextSpawn = PlayerPrefs.GetString("NextSpawn", "");

        if (!string.IsNullOrEmpty(nextSpawn))
        {
            TeleportLocate[] spawnPoints = GameObject.FindObjectsByType<TeleportLocate>(
                FindObjectsSortMode.None);

            foreach (TeleportLocate sp in spawnPoints)
            {
                if (sp.locateID == nextSpawn)
                {
                    transform.position = sp.transform.position;
                    break;
                }
            }
        }
    }

    private void OnDestroy()
    {
        // Remove o listener para evitar memory leak
        SceneManager.sceneLoaded -= OnSceneLoaded;
    }
}